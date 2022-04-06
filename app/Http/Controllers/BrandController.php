<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Image;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.brand.index');
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function getData()
    {
        $brand = Brand::all();

        return DataTables::of($brand)
            ->addIndexColumn()
            ->addColumn('image',function ($brand){
                if ($brand->brand_image)
                {
                    $url=asset("assets/brand/medium/$brand->brand_image");
                    return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
                }

            })
            ->editColumn('action', function ($brand) {
                $return = "<div class=\"btn-group\">";
                if (!empty($brand->name))
                {
                    $return .= "
                                  <a href=\"/brand/edit/$brand->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$brand->id\" rel1=\"brand/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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

    public function store(BrandRequest $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                if($request->hasFile('brand_image')){

                    $image_tmp = $request->file('brand_image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;

                        $original_image_path = public_path().'/assets/brand/original/'.$filename;
                        $large_image_path = public_path().'/assets/brand/large/'.$filename;
                        $medium_image_path = public_path().'/assets/brand/medium/'.$filename;
                        $small_image_path = public_path().'/assets/brand/small/'.$filename;

                        //Resize Image
                        Image::make($image_tmp)->save($original_image_path);
                        Image::make($image_tmp)->resize(1200,600)->save($large_image_path);
                        Image::make($image_tmp)->resize(500,500)->save($medium_image_path);
                        Image::make($image_tmp)->resize(200,60)->save($small_image_path);

                    }
                }

                //cretae brand

                $brand = new Brand();

                $brand->name = $request->name;
                $brand->brand_image = $filename;

                $brand->save();

                DB::commit();

                return response()->json([
                    'message' => 'Brand Added Successful',
                    'status_code' => 200
                ],200);
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
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', compact('brand'));
    }

    public function update(BrandRequest $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                if($request->hasFile('brand_image')){

                    $image_tmp = $request->file('brand_image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;

                        $original_image_path = public_path().'/assets/brand/original/'.$filename;
                        $large_image_path = public_path().'/assets/brand/large/'.$filename;
                        $medium_image_path = public_path().'/assets/brand/medium/'.$filename;
                        $small_image_path = public_path().'/assets/brand/small/'.$filename;

                        //Resize Image
                        Image::make($image_tmp)->save($original_image_path);
                        Image::make($image_tmp)->resize(1200,600)->save($large_image_path);
                        Image::make($image_tmp)->resize(500,500)->save($medium_image_path);
                        Image::make($image_tmp)->resize(200,60)->save($small_image_path);

                    }
                }else{
                    $filename = $request->current_image;
                }

                //cretae brand

                $brand = Brand::findOrFail($id);

                $brand->name = $request->name;
                $brand->brand_image = $filename;

                $brand->save();

                DB::commit();

                return response()->json([
                    'message' => 'Brand Updated Successful',
                    'status_code' => 200
                ],200);
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
        $brand = Brand::findOrFail($id);

        if ($brand->brand_image != null)
        {
            $original_image_path = public_path().'/assets/brand/original/'.$brand->brand_image;
            $large_image_path = public_path().'/assets/brand/large/'.$brand->brand_image;
            $medium_image_path = public_path().'/assets/brand/medium/'.$brand->brand_image;
            $small_image_path = public_path().'/assets/brand/small/'.$brand->brand_image;

            unlink($original_image_path);
            unlink($large_image_path);
            unlink($medium_image_path);
            unlink($small_image_path);
        }

        $brand->update(['brand_image' => null]);

        return response()->json([
            'message' => 'Brand Image Deleted Successful',
            'status_code' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return response()->json([
            'message' => 'Brand Destroy Successful',
            'status_code' => 200
        ], 200);
    }
}
