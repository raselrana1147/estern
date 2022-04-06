<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DropUpController extends Controller
{
    public function index()
    {
        return view('admin.drop_up.index');
    }

    public function getData()
    {
        $drop_up = DB::table('drop_up')
            ->select(
                'drop_up.id as id',
                'users.name as customer_name',
                'users.phone as phone',
                'drop_up.address as address',
                'drop_up.service_id as service_id',
                'drop_up.drop_up_cost as drop_up_cost',
                'drop_up.sub_total as sub_total'
            )
            ->join('customer_services','drop_up.service_id','=','customer_services.service_id')
            ->join('quotes','customer_services.quote_id','=','quotes.id')
            ->join('users','quotes.user_id','=','users.id')
            ->get();

        return DataTables::of($drop_up)
            ->addIndexColumn()
            ->editColumn('action', function ($drop_up) {
                $return = "<div class=\"btn-group\">";
                if (!empty($drop_up->id))
                {
                    $return .= "
                                  <a href=\"/drop_up/drop_assign_rider/$drop_up->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"Assign Rider\">
                                      <i class=\"fa fa-plus\"></i>
                                    </a>
                                    
                                    <a rel=\"$drop_up->id\" rel1=\"drop_up/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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
        $drop_up = DB::table('drop_up')->where('drop_up.id',$id)->first();

        if ($drop_up)
        {
            DB::table('rider_assign')->where('rider_assign.drop_up_id',$drop_up->id)->delete();
        }

        DB::table('drop_up')->where('drop_up.id',$id)->delete();

        return response()->json([
            'message' => 'Drop up request destroy successful',
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function dropAssignRider($id)
    {
        $drop_up = DB::table('drop_up')->where('drop_up.id',$id)->first();

        return view('admin.drop_up.drop_assign_rider', compact('drop_up'));
    }

    public function dropAssignRiderGetData()
    {
        $drop_up_id = $_GET['id'];

        $rider_assign = DB::table('rider_assign')
                            ->select(
                                'rider_assign.id as id',
                                'rider_assign.status as status',
                                'users.name as rider_name',
                                'users.phone as rider_phone',
                                'drop_up.address as address',
                                'drop_up.service_id as service_id',
                                'drop_up.drop_up_cost as drop_up_cost'
                            )
                            ->join('drop_up','rider_assign.drop_up_id','=','drop_up.id')
                            ->join('customer_services','drop_up.service_id','=','customer_services.service_id')
                            ->join('users','rider_assign.rider_id','=','users.id')
                            ->where('rider_assign.drop_up_id',$drop_up_id)
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
                                  <a href=\"/drop_up/drop_assign_rider_edit/$rider_assign->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"Assign Rider\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$rider_assign->id\" rel1=\"drop_up/drop_assign_rider_destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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

    public function dropAssignRiderCreate($id)
    {
        $drop_up = DB::table('drop_up')->where('drop_up.id',$id)->first();

        $rider = DB::table('users')->where('users.user_role_id',5)->get();

        return view('admin.drop_up.drop_assign_rider_create',compact('drop_up','rider'));
    }

    public function dropAssignRiderStore(Request $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create assign rider

                $rider_assign = DB::table('rider_assign')->where('rider_assign.drop_up_id', $request->drop_up_id)->orWhere('date','=',Carbon::now())->count();

                if ($rider_assign > 0){
                    return response()->json([
                        'message' => 'This Drop up request rider assign already',
                        'status_code' => 200
                    ],200);
                }else{
                    DB::table('rider_assign')->insert([
                        'drop_up_id' => $request->drop_up_id,
                        'rider_id' => $request->rider_id,
                        'drop_up_cost' => $request->drop_up_cost,
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

    public function dropAssignRiderEdit($id)
    {
        $drop_assign_rider = DB::table('rider_assign')->where('rider_assign.id',$id)->first();

        $drop_up = DB::table('drop_up')->where('drop_up.id',$drop_assign_rider->drop_up_id)->first();

        $rider = DB::table('users')->where('users.user_role_id',5)->get();

        return view('admin.drop_up.drop_up_assign_rider_edit', compact('drop_assign_rider','drop_up','rider'));
    }

    public function dropAssignRiderUpdate(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //update rider

                DB::table('rider_assign')->where('rider_assign.id',$id)->update([
                    'drop_up_id' => $request->drop_up_id,
                    'rider_id' => $request->rider_id,
                    'drop_up_cost' => $request->drop_up_cost,
                    'date' => $request->date,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::commit();

                return response()->json([
                    'message' => 'Drop up rider assign update successful',
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

    public function dropAssignRiderDestroy($id)
    {
        DB::table('rider_assign')->where('rider_assign.id',$id)->delete();

        return response()->json([
            'message' => 'Drop up rider destroy successful',
            'status_code' => 200
        ],Response::HTTP_OK);
    }
}
