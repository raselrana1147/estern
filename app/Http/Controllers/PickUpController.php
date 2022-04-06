<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PickUpController extends Controller
{
    public function index()
    {
        return view('admin.pick_up.index');
    }

    public function getData()
    {


        $pick_up = DB::table('pick_up')
                        ->select(
                            'pick_up.id as id',
                            'users.name as customer_name',
                            'users.phone as phone',
                            'pick_up.address as address',
                            'pick_up.service_id as service_id',
                            'pick_up.pick_up_cost as pick_up_cost',
                            'pick_up.sub_total as sub_total'
                        )
                        ->join('customer_services','pick_up.service_id','=','customer_services.service_id')
                        ->join('quotes','customer_services.quote_id','=','quotes.id')
                        ->join('users','quotes.user_id','=','users.id')
                        ->get();

        return DataTables::of($pick_up)
            ->addIndexColumn()
            ->editColumn('action', function ($pick_up) {
                $return = "<div class=\"btn-group\">";
                if (!empty($pick_up->id))
                {
                    $return .= "
                                  <a href=\"/pick_up/assign_rider/$pick_up->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"Assign Rider\">
                                      <i class=\"fa fa-plus\"></i>
                                    </a>
                                    
                                    <a rel=\"$pick_up->id\" rel1=\"pick_up/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action'
            ])
            ->make(true);
    }

    public function destroy($id)
    {
        $pick_up = DB::table('pick_up')->where('pick_up.id',$id)->first();

        if ($pick_up)
        {
            DB::table('rider_assign')->where('pick_up_id',$pick_up->id)->delete();
        }

        DB::table('pick_up')->where('pick_up.id',$id)->delete();

        return response()->json([
            'message' => 'Pick up destroy successful',
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function assignRider($id)
    {
        $pick_up = DB::table('pick_up')->where('pick_up.id',$id)->first();

        return view('admin.pick_up.assign_rider', compact('pick_up'));
    }

    public function assign_rider_create($id)
    {
        $pick_up = DB::table('pick_up')->where('pick_up.id',$id)->first();

        $rider = DB::table('users')->where('users.user_role_id',5)->get();

        return view('admin.pick_up.assign_rider_create', compact('pick_up','rider'));
    }

    public function assign_rider_store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create assign rider

                $rider_assign = DB::table('rider_assign')->where('rider_assign.pick_up_id',$request->pick_up_id)->orWhere('date','=',Carbon::now())->count();

                if ($rider_assign > 0){
                    return response()->json([
                        'message' => 'This pick up request rider assign already',
                        'status_code' => 200
                    ],200);
                }else{
                    DB::table('rider_assign')->insert([
                        'pick_up_id' => $request->pick_up_id,
                        'rider_id' => $request->rider_id,
                        'pick_up_cost' => $request->pick_up_cost,
                        'date' => $request->date,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);

                    DB::commit();

                    return response()->json([
                        'message' => 'Rider Assign Successful',
                        'status_code' => 200
                    ],Response::HTTP_OK);
                }

            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function assignRiderGetData()
    {
        $pick_up_id = $_GET['pick_up_id'];

        $rider_assign = DB::table('rider_assign')
                            ->select(
                                'rider_assign.id as id',
                                'rider_assign.status as status',
                                'users.name as rider_name',
                                'users.phone as rider_phone',
                                'pick_up.address as address',
                                'pick_up.service_id as service_id',
                                'pick_up.pick_up_cost as pick_up_cost'
                            )
                            ->join('pick_up','rider_assign.pick_up_id','=','pick_up.id')
                            ->join('customer_services','pick_up.service_id','=','customer_services.service_id')
                            ->join('users','rider_assign.rider_id','=','users.id')
                            ->where('rider_assign.pick_up_id',$pick_up_id)
                            ->get();

        return DataTables::of($rider_assign)
            ->addIndexColumn()
            ->addColumn('status',function ($rider_assign){
                if($rider_assign->status == 0)
                {
                    return '<div>
                            <label class="switch patch">
                                <input type="checkbox" class="status_toggle" data-value="'.$rider_assign->id.'" id="status_change" value="'.$rider_assign->id.'">
                                <span class="slider"></span>
                            </label>
                          </div>';
                }else{
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox" id="status_change"  class="status_toggle" data-value="'.$rider_assign->id.'"  value="'.$rider_assign->id.'" checked>
                            <span class="slider"></span>
                        </label>
                      </div>';
                }

            })
            ->editColumn('action', function ($rider_assign) {
                $return = "<div class=\"btn-group\">";
                if (!empty($rider_assign->id))
                {
                    $return .= "
                                  <a href=\"/pick_up/assign_rider_edit/$rider_assign->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"Assign Rider\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$rider_assign->id\" rel1=\"pick_up/assign_rider_destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action','status'
            ])
            ->make(true);
    }

    public function assign_rider_status($id)
    {
        $rider_assign = DB::table('rider_assign')->where('rider_assign.id',$id)->first();

        if ($rider_assign->status == 0){
            DB::table('rider_assign')->where('rider_assign.id',$id)->update(['status' => 1]);

            return response()->json([
                'message' => 'Rider store product in shop',
                'status_code' => 200
            ],Response::HTTP_OK);
        }else{
            DB::table('rider_assign')->where('rider_assign.id',$id)->update(['status' => 0]);

            return response()->json([
                'message' => 'Rider not store product in shop',
                'status_code' => 200
            ],Response::HTTP_OK);
        }
    }

    public function assign_rider_edit($id)
    {
        $rider_assign =  DB::table('rider_assign')->where('rider_assign.id',$id)->first();

        $pick_up = DB::table('pick_up')->where('pick_up.id',$rider_assign->pick_up_id)->first();

        $rider = DB::table('users')->where('users.user_role_id',5)->get();

        return view('admin.pick_up.assign_rider_edit',compact('rider_assign','pick_up','rider'));
    }

    public function assign_rider_update(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //update rider

                DB::table('rider_assign')->where('rider_assign.id',$id)->update([
                    'pick_up_id' => $request->pick_up_id,
                    'rider_id' => $request->rider_id,
                    'pick_up_cost' => $request->pick_up_cost,
                    'date' => $request->date,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::commit();

                return response()->json([
                    'message' => 'Rider Assign Updated Successful',
                    'status_code' => 200
                ],Response::HTTP_OK);
            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function assign_rider_destroy($id)
    {
        DB::table('rider_assign')->where('rider_assign.id',$id)->delete();

        return response()->json([
            'message' => 'Rider assign deleted successful',
            'status_code' => 200
        ],Response::HTTP_OK);
    }
}
