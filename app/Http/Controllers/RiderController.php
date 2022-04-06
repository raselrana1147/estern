<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Yajra\DataTables\Facades\DataTables;

class RiderController extends Controller
{
    public function index()
    {
        return view('admin.rider.index');
    }

    public function create()
    {
        return view('admin.rider.create');
    }

    public function getData()
    {
        $rider = DB::table('users')
                    ->select(
                        'users.id as id',
                        'users.name as name',
                        'users.phone as phone',
                        'users.email as email',
                        'users.image as image',
                        'rider_info.country as country',
                        'rider_info.city as city',
                        'rider_info.address as address',
                        'rider_info.card_number as card_number',
                        'user_role.role_name as role_name'
                    )
                    ->join('rider_info','users.id','=','rider_info.user_id')
                    ->join('user_role','users.user_role_id','=','user_role.id')
                    ->where('users.user_role_id',5)
                    ->orderBy('users.id', 'desc')
                    ->get();

        return DataTables::of($rider)
            ->addIndexColumn()
            ->addColumn('image',function ($rider){
                if ($rider->image)
                {
                    $url=asset("assets/rider/small/$rider->image");
                    return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
                }

            })
            ->editColumn('action', function ($rider) {
                $return = "<div class=\"btn-group\">";
                if (!empty($rider->name))
                {
                    $return .= "
                                  <a href=\"/rider/edit/$rider->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$rider->id\" rel1=\"rider/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
                                    
                                     <a href=\"/rider/change_password/$rider->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-key\"></i>
                                    </a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action','image'
            ])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'phone' => 'required'
        ]);

        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                //create rider

                $rider = new User();

                $rider->name = $request->name;
                $rider->email = $request->email;


                if($request->hasFile('image')){

                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;

                        $original_image_path = public_path().'/assets/rider/original/'.$filename;
                        $large_image_path = public_path().'/assets/rider/large/'.$filename;
                        $medium_image_path = public_path().'/assets/rider/medium/'.$filename;
                        $small_image_path = public_path().'/assets/rider/small/'.$filename;

                        //Resize Image
                        Image::make($image_tmp)->save($original_image_path);
                        Image::make($image_tmp)->resize(1920,680)->save($large_image_path);
                        Image::make($image_tmp)->resize(1000,529)->save($medium_image_path);
                        Image::make($image_tmp)->resize(100,75)->save($small_image_path);

                        $rider->image = $filename;

                    }
                }

                $rider->phone = $request->phone;
                $rider->user_role_id = 5;
                $rider->password = bcrypt($request->password);

                $rider->save();

                $last_id = DB::getPdo()->lastInsertId();

                DB::table('rider_info')->insert([
                    'user_id' => $last_id,
                    'nid' => $request->nid,
                    'country' => $request->country,
                    'city' => $request->city,
                    'zip' => $request->zip,
                    'postal_code' => $request->postal_code,
                    'address' => $request->address,
                    'card_number' => rand(1111111,9999999),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                DB::commit();

                return response()->json([
                    'message' => 'Rider Added Successful',
                    'status_code' => 200
                ]);
            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ], 500);
            }
        }
    }

    public function edit($id)
    {
        $rider = DB::table('users')
                ->select(
                    'users.id as id',
                    'users.user_role_id as user_role_id',
                    'users.name as name',
                    'users.phone as phone',
                    'users.email as email',
                    'users.image as image',
                    'rider_info.id as riderId',
                    'rider_info.country as country',
                    'rider_info.city as city',
                    'rider_info.address as address',
                    'rider_info.card_number as card_number',
                    'rider_info.nid as nid',
                    'rider_info.zip as zip',
                    'rider_info.postal_code as postal_code'
                )
                ->leftJoin('rider_info','users.id','=','rider_info.user_id')
                ->where('users.id', $id)
                ->first();

        //dd($rider);

        return view('admin.rider.edit', compact('rider'));
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                //create rider

                $rider = User::findOrFail($id);

                $rider->name = $request->name;
                $rider->email = $request->email;


                if($request->hasFile('image')){

                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;

                        $original_image_path = public_path().'/assets/rider/original/'.$filename;
                        $large_image_path = public_path().'/assets/rider/large/'.$filename;
                        $medium_image_path = public_path().'/assets/rider/medium/'.$filename;
                        $small_image_path = public_path().'/assets/rider/small/'.$filename;

                        //Resize Image
                        Image::make($image_tmp)->save($original_image_path);
                        Image::make($image_tmp)->resize(1920,680)->save($large_image_path);
                        Image::make($image_tmp)->resize(1000,529)->save($medium_image_path);
                        Image::make($image_tmp)->resize(100,75)->save($small_image_path);

                    }
                }else{
                    $filename = $request->current_image;
                }

                $rider->image = $filename;
                $rider->phone = $request->phone;
                $rider->user_role_id = 5;

                $rider->save();

                $last_id = DB::getPdo()->lastInsertId();

                DB::table('rider_info')->insert([
                    'user_id' => $last_id,
                    'nid' => $request->nid,
                    'country' => $request->country,
                    'city' => $request->city,
                    'zip' => $request->zip,
                    'postal_code' => $request->postal_code,
                    'address' => $request->address,
                    'card_number' => rand(1111111,9999999),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                DB::commit();

                return response()->json([
                    'message' => 'Rider Updated Successful',
                    'status_code' => 200
                ]);
            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ], 500);
            }
        }
    }

    public function delete_image($id)
    {
        $rider = User::findOrFail($id);

        if ($rider->image != null)
        {
            $original = public_path().'/assets/rider/original/'.$rider->image;
            $large = public_path().'/assets/rider/large/'.$rider->image;
            $medium = public_path().'/assets/rider/medium/'.$rider->image;
            $small = public_path().'/assets/rider/small/'.$rider->image;

            unlink($original);
            unlink($large);
            unlink($medium);
            unlink($small);
        }

        $rider->update(['image' => null]);

        return response()->json([
            'message' => 'Rider Image Destroy Successful',
            'status_code' => 200
        ], 200);
    }

    public function destroy($id)
    {

        $rider = User::where('id',$id)->orwhere('user_role_id', 5)->first();

        DB::table('rider_info')->where('rider_info.user_id', $rider->id)->delete();

        if ($rider->image != null)
        {
            $original = public_path().'/assets/rider/original/'.$rider->image;
            $large = public_path().'/assets/rider/large/'.$rider->image;
            $medium = public_path().'/assets/rider/medium/'.$rider->image;
            $small = public_path().'/assets/rider/small/'.$rider->image;

            unlink($original);
            unlink($large);
            unlink($medium);
            unlink($small);
        }

        $rider->delete();

        return response()->json([
            'message' => 'Rider Deleted Successful',
            'status_code' => 200
        ], 200);
    }

    public function changePassword($id)
    {
        $rider = User::findOrFail($id);

        return view('admin.rider.change_password', compact('rider'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                $rider = User::findOrFail($id);

                $rider->password = bcrypt($request->password);

                $rider->save();

                DB::commit();

                return response()->json([
                    'message' => 'Rider password Change Successful',
                    'status_code' => 200
                ], 200);
            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ], 500);
            }
        }
    }
}
