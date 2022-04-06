<?php

namespace App\Http\Controllers;

use App\Cupon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Image;
use Illuminate\Support\Facades\File;

class CuponController extends Controller
{
    public function index()
    {
        return view('admin.coupon.index');
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function getData()
    {
        $coupon = Cupon::latest()->get();

        return DataTables::of($coupon)
            ->addIndexColumn()
            ->addColumn('status',function ($coupon){
                if (strtotime($coupon->end_date) < strtotime(date('Y-m-d')))
                {
                    return "<span>Invalid</span>";
                }else{
                    return "<span>Valid</span>";
                }

            })
            ->addColumn('image',function ($coupon){
                if ($coupon->image)
                {
                    $url=asset("assets/coupon/small/$coupon->image");
                    return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
                }

            })
            ->editColumn('action', function ($coupon) {
                $return = "<div class=\"btn-group\">";
                if (!empty($coupon->id))
                {
                    $return .= "
                                  <a href=\"/coupon/edit/$coupon->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$coupon->id\" rel1=\"coupon/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'action','status','image'
            ])
            ->make(true);
    }

    public function store(Request $request)
    {

         $this->validate($request,[
            'coupon_code'=>'required',
            'coupon_amount'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'image'=>'required',
        ]);
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create coupon

                $coupon = new Cupon();

                $coupon->coupon_code = $request->coupon_code;
                $coupon->coupon_amount = $request->coupon_amount;
                $coupon->start_date = $request->start_date;
                $coupon->end_date = $request->end_date;

                if($request->hasFile('image')){

                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;

                        $original_image_path = public_path().'/assets/coupon/original/'.$filename;
                        $large_image_path = public_path().'/assets/coupon/large/'.$filename;
                        $medium_image_path = public_path().'/assets/coupon/medium/'.$filename;
                        $small_image_path = public_path().'/assets/coupon/small/'.$filename;

                        //Resize Image
                        Image::make($image_tmp)->save($original_image_path);
                        Image::make($image_tmp)->resize(1920,680)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(250,232)->save($small_image_path);
                        $coupon->image = $filename;

                    }
                }
                $coupon->save();

                DB::commit();

                return response()->json([
                    'message' => 'Coupon added successful',
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

    public function edit($id)
    {
        $coupon = Cupon::findOrFail($id);

        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
          $this->validate($request,[
             'coupon_code'=>'required',
             'coupon_amount'=>'required',
             'start_date'=>'required',
             'end_date'=>'required',
         ]);

        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //update coupon

                $coupon = Cupon::findOrFail($id);

                $coupon->coupon_code = $request->coupon_code;
                $coupon->coupon_amount = $request->coupon_amount;
                $coupon->start_date = $request->start_date;
                $coupon->end_date = $request->end_date;

                if($request->hasFile('image')){

                    ////delete lod image

                    if (file_exists(public_path().'/assets/coupon/original/'.$coupon->image))
                    {
                        File::delete(public_path().'/assets/coupon/original/'.$coupon->image);
                    }

                    if (file_exists(public_path().'/assets/coupon/large/'.$coupon->image))
                    {
                        File::delete(public_path().'/assets/coupon/large/'.$coupon->image);
                    }
                    if (file_exists(public_path().'/assets/coupon/medium/'.$coupon->image))
                    {
                        File::delete(public_path().'/assets/coupon/medium/'.$coupon->image);
                    }
                    if (file_exists(public_path().'/assets/coupon/small/'.$coupon->image))
                    {
                        File::delete(public_path().'/assets/coupon/small/'.$coupon->image);
                    }
                    // end delete

                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;

                        $original_image_path = public_path().'/assets/coupon/original/'.$filename;
                        $large_image_path = public_path().'/assets/coupon/large/'.$filename;
                        $medium_image_path = public_path().'/assets/coupon/medium/'.$filename;
                        $small_image_path = public_path().'/assets/coupon/small/'.$filename;

                        //Resize Image
                        Image::make($image_tmp)->save($original_image_path);
                        Image::make($image_tmp)->resize(1920,680)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(250,232)->save($small_image_path);
                        $coupon->image = $filename;

                    }
                }

                $coupon->save();

                DB::commit();

                return response()->json([
                    'message' => 'Coupon updated successful',
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

    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('delete'))
        {
            $coupon = Cupon::findOrFail($id);
           

            if (file_exists(public_path().'/assets/coupon/original/'.$coupon->image))
            {
                File::delete(public_path().'/assets/coupon/original/'.$coupon->image);
            }

            if (file_exists(public_path().'/assets/coupon/large/'.$coupon->image))
            {
                File::delete(public_path().'/assets/coupon/large/'.$coupon->image);
            }
            if (file_exists(public_path().'/assets/coupon/medium/'.$coupon->image))
            {
                File::delete(public_path().'/assets/coupon/medium/'.$coupon->image);
            }
            if (file_exists(public_path().'/assets/coupon/small/'.$coupon->image))
            {
                File::delete(public_path().'/assets/coupon/small/'.$coupon->image);
            }
             $coupon->delete();

            return response()->json([
                'message' => 'Coupon destroy successful',
                'status_code' => 200
            ],Response::HTTP_OK);
        }

    }

    public function UserCouponList()
    {
        return view('admin.coupon.user_coupon_list');
    }

    public function user_coupon_getData()
    {
        $user_coupon_list = DB::table('user_coupons')
                                ->select(
                                    'user_coupons.id as id',
                                    'users.name as customer_name',
                                    'users.phone as customer_phone',
                                    'user_role.role_name as customer_role',
                                    'cupons.coupon_code as coupon_code',
                                    'cupons.coupon_amount as coupon_amount',
                                    'cupons.image as coupon_image'
                                )
                                ->leftJoin('users','user_coupons.user_id','=','users.id')
                                ->leftJoin('user_role','users.user_role_id','=','user_role.id')
                                ->leftJoin('cupons','user_coupons.coupon_id','=','cupons.id')
                                ->get();

        return DataTables::of($user_coupon_list)
            ->addColumn('coupon_image',function ($user_coupon_list){
                
                    $url=asset("assets/coupon/small/$user_coupon_list->coupon_image");
                    return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
                

            })
            ->rawColumns([
                'coupon_image'
            ])
            ->addIndexColumn()
            ->make(true);
    }
}
