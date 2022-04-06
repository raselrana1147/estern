<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Catgeory;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function create()
    {
        $category = Catgeory::get();
        $brand = Brand::get();

        return view('admin.product.create', compact('category','brand'));
    }

    public function view($id)
    {
        $product = Product::getViewProduct($id);

        //dd($product);

        return view('admin.product.view', compact('product'));
    }

    public function get_sub_category()
    {
        if (isset($_GET['category_id']))
        {
            $category_id = $_GET['category_id'];

            $option = '';

            $query = DB::table('sub_categories')
                ->select(
                    'sub_categories.id as id',
                    'sub_categories.name as name'
                )
                ->join('catgeories','sub_categories.category_id','=','catgeories.id')
                ->where('sub_categories.category_id',$category_id)
                ->get();
            //dd($query);

            $option .= "<option value=''>Select Sub-Category</option>";

            foreach ($query as $value) {

                $id = $value->id;

                $sub_cat_name = $value->name;

                $option .= " <option value=" . $id . ">" . $sub_cat_name . "</option>";

                //$show = array("id"=>$id, "subject_name"=>$subject_name);
            }

            echo $option;
        }
    }

    public function getData()
    {
        $product = DB::table('products')
                    ->select(
                        'products.*',
                        'catgeories.name as cat_name',
                        'sub_categories.name as sub_cat_name',
                        'brands.name as brand_name'
                    )
                    ->join('catgeories','products.category_id','=','catgeories.id')
                    ->join('sub_categories','products.sub_cat_id','=','sub_categories.id')
                    ->join('brands','products.brand_id','=','brands.id')
                    ->orderBy('products.id','desc')
                    ->get();


        return DataTables::of($product)
            ->addIndexColumn()
            ->addColumn('image',function ($product){
                if ($product->image)
                {
                    $url=asset("assets/uploads/small/$product->image");
                    return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
                }

            })
            ->addColumn('status',function ($product){
                if($product->status == 0)
                {

                    return '<div>
                            <label class="switch patch">
                                <input type="checkbox" class="status_toggle" data-value="'.$product->id.'" id="status_change" value="'.$product->id.'">
                                <span class="slider"></span>
                            </label>
                          </div>';
                }else{
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox" id="status_change"  class="status_toggle" data-value="'.$product->id.'"  value="'.$product->id.'" checked>
                            <span class="slider"></span>
                        </label>
                      </div>';
                }

            })
            ->addColumn('publish',function ($product){

                if ($product->publish == 0)
                {
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox" id="publish_change" class="publish_toggle" data-value="'.$product->id.'" value="'.$product->id.'">
                            <span class="slider"></span>
                        </label>
                      </div>';
                }else{
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox" id="publish_change" class="publish_toggle" data-value="'.$product->id.'" value="'.$product->id.'" checked>
                            <span class="slider"></span>
                        </label>
                      </div>';
                }

            })

            ->addColumn('feature',function ($product){

                if ($product->feature == 0)
                {
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox" id="feature_change" class="feature_toggle" data-value="'.$product->id.'" value="'.$product->id.'">
                            <span class="slider"></span>
                        </label>
                      </div>';
                }else{
                    return '<div>
                        <label class="switch patch">
                            <input type="checkbox" id="feature_change" class="feature_toggle" data-value="'.$product->id.'" value="'.$product->id.'" checked>
                            <span class="slider"></span>
                        </label>
                      </div>';
                }

            })
            ->editColumn('action', function ($product) {
                $return = "<div class=\"btn-group\">";
                if (!empty($product->id))
                {
                    $return .= "
                                 <a href=\"/product/view/$product->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-eye\"></i>
                                    </a>
                                    
                                    <a href=\"/product/edit/$product->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$product->id\" rel1=\"product/destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
                                    
                                    <a href=\"/product/image/$product->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-image\"></i>
                                    </a>
                                  ";
                }
                $return .= "</div>";
                return $return;
            })
            ->rawColumns([
                'image','status','publish','feature','action'
            ])
            ->make(true);
    }

    public function status_change($id)
    {
        $product = Product::findOrFail($id);

        if ($product->status == 0)
        {
            $product->update(['status' => 1]);

            return response()->json([
                'message' => 'Product is approve',
                'status_code' => 200
            ], 200);
        }else{
            $product->update(['status' => 0]);

            return response()->json([
                'message' => 'Product  approve is Remove',
                'status_code' => 200
            ], 200);
        }
    }

    public function publish_change($id)
    {
        $product = Product::findOrFail($id);

        if ($product->publish == 0)
        {
            $product->update(['publish' => 1]);

            return response()->json([
                'message' => 'Product is publish',
                'status_code' => 200
            ], 200);
        }else{
            $product->update(['publish' => 0]);

            return response()->json([
                'message' => 'Product  publish is remove',
                'status_code' => 200
            ], 200);
        }
    }

    public function feature_change($id)
    {
        $product = Product::findOrFail($id);

        if ($product->feature == 0)
        {
            $product->update(['feature' => 1]);

            return response()->json([
                'message' => 'Product is feature',
                'status_code' => 200
            ], 200);
        }else{
            $product->update(['feature' => 0]);

            return response()->json([
                'message' => 'Product  feature is remove',
                'status_code' => 200
            ], 200);
        }
    }

    public function store(ProductRequest $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create product

                if($request->hasFile('image')){

                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;

                        $original_image_path = public_path().'/assets/uploads/original/'.$filename;
                        $large_image_path = public_path().'/assets/uploads/large/'.$filename;
                        $medium_image_path = public_path().'/assets/uploads/medium/'.$filename;
                        $small_image_path = public_path().'/assets/uploads/small/'.$filename;
                        $xsmall_image_path = public_path().'/assets/uploads/xtra_small/'.$filename;

                        //Resize Image
                        Image::make($image_tmp)->save($original_image_path);
                        Image::make($image_tmp)->resize(1920,680)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(250,232)->save($small_image_path);
                        Image::make($image_tmp)->resize(180,180)->save($xsmall_image_path);

                    }
                }

                $product = new Product();

                $product->category_id = $request->category_id;
                $product->sub_cat_id = $request->sub_cat_id;
                $product->brand_id = $request->brand_id;
                $product->model = $request->model;
                $product->code = $request->code;
                $product->name = $request->name;
                $product->title = $request->title;
                $product->description = $request->description;
                $product->image = $filename;
                $product->price = $request->price;
                $product->quantity = $request->quantity;
                $product->color = $request->color;
                $product->warranty = $request->warranty;
                $product->pro_type = $request->pro_type;
                $product->previous_price = $request->previous_price;
                $product->discount = $request->discount;

                if (!empty($request->status))
                {
                    $product->status = 1;
                }else{
                    $product->status = 0;
                }

                if (!empty($request->publish))
                {
                    $product->publish = 1;
                }else{
                    $product->publish = 0;
                }

                if (!empty($request->feature))
                {
                    $product->feature = 1;
                }else{
                    $product->feature = 0;
                }

                if (!empty($request->new_arrival))
                {
                    $product->new_arrival = 1;
                }else{
                    $product->new_arrival = 0;
                }

                $product->save();

                DB::commit();

                return response()->json([
                    'message' => 'Product Added Successful',
                    'status_code' => 200
                ], 200);


            }catch(QueryException $e){
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
        $product = Product::findOrFail($id);

        $category = Catgeory::get();

        $sub_category = SubCategory::get();

        $brand = Brand::get();

        return view('admin.product.edit', compact('product','category','brand','sub_category'));
    }

    public function update(ProductRequest $request, $id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create product

                if($request->hasFile('image')){

                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;

                        $original_image_path = public_path().'/assets/uploads/original/'.$filename;
                        $large_image_path = public_path().'/assets/uploads/large/'.$filename;
                        $medium_image_path = public_path().'/assets/uploads/medium/'.$filename;
                        $small_image_path = public_path().'/assets/uploads/small/'.$filename;
                        $xsmall_image_path = public_path().'/assets/uploads/xtra_small/'.$filename;

                        //Resize Image
                        Image::make($image_tmp)->save($original_image_path);
                        Image::make($image_tmp)->resize(1920,680)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(250,232)->save($small_image_path);
                        Image::make($image_tmp)->resize(180,180)->save($xsmall_image_path);

                    }
                }else{
                    $filename = $request->current_image;
                }

                $product = Product::findOrFail($id);

                $product->category_id = $request->category_id;
                $product->sub_cat_id = $request->sub_cat_id;
                $product->brand_id = $request->brand_id;
                $product->model = $request->model;
                $product->code = $request->code;
                $product->name = $request->name;
                $product->title = $request->title;
                $product->description = $request->description;
                $product->image = $filename;
                $product->price = $request->price;
                $product->quantity = $request->quantity;
                $product->color = $request->color;
                $product->warranty = $request->warranty;
                $product->pro_type = $request->pro_type;
                $product->previous_price = $request->previous_price;
                $product->discount = $request->discount;

                if (!empty($request->status))
                {
                    $product->status = 1;
                }else{
                    $product->status = 0;
                }

                if (!empty($request->publish))
                {
                    $product->publish = 1;
                }else{
                    $product->publish = 0;
                }

                if (!empty($request->feature))
                {
                    $product->feature = 1;
                }else{
                    $product->feature = 0;
                }

                if (!empty($request->new_arrival))
                {
                    $product->new_arrival = 1;
                }else{
                    $product->new_arrival = 0;
                }

                $product->save();

                DB::commit();

                return response()->json([
                    'message' => 'Product Updated Successful',
                    'status_code' => 200
                ], 200);


            }catch(QueryException $e){
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
        $product = Product::findOrFail($id);

        if ($product->image != null)
        {
            $original_path = public_path().'/assets/uploads/original/'.$product->image;
            $large_path = public_path().'/assets/uploads/large/'.$product->image;
            $medium_path = public_path().'/assets/uploads/medium/'.$product->image;
            $small_path = public_path().'/assets/uploads/small/'.$product->image;

            unlink($original_path);
            unlink($large_path);
            unlink($medium_path);
            unlink($small_path);
        }

        $product->update(['image' => null]);

        return response()->json([
            'message' => 'Product Image Deleted Successful',
            'status_code' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image != null)
        {
            $original_path = public_path().'/assets/uploads/original/'.$product->image;
            $large_path = public_path().'/assets/uploads/large/'.$product->image;
            $medium_path = public_path().'/assets/uploads/medium/'.$product->image;
            $small_path = public_path().'/assets/uploads/small/'.$product->image;

            unlink($original_path);
            unlink($large_path);
            unlink($medium_path);
            unlink($small_path);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product Deleted Successful',
            'status_code' => 200
        ], 200);
    }

    public function image($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.product.product_image.index', compact('product'));
    }

    public function image_create($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.product.product_image.create', compact('product'));
    }

    public function image_getData()
    {
        $product_id = $_GET['id'];

        $product_images = DB::table('product_image')
            ->select(
                'product_image.*',
                'products.name as name'
            )
            ->join('products','product_image.product_id','=','products.id')
            ->where('product_image.product_id', $product_id)
            ->get();

        //dd($product_image);

        return DataTables::of($product_images)
            ->addIndexColumn()
            ->addColumn('image',function ($product_images){
                if ($product_images->product_image)
                {
                    $url=asset("assets/product/small/$product_images->product_image");
                    return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
                }

            })
            ->editColumn('action', function ($product_images) {
                $return = "<div class=\"btn-group\">";
                if (!empty($product_images->id))
                {
                    $return .= "
                                  <a href=\"/product/image_edit/$product_images->id\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">
                                      <i class=\"fa fa-edit\"></i>
                                    </a>
                                    
                                    <a rel=\"$product_images->id\" rel1=\"product/image_destroy\" href=\"javascript:\" style='margin-right: 5px' class=\"btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord \"><i class='fa fa-trash'></i></a>
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

    public function image_upload(Request $request,$id)
    {

//        $product = Product::findOrFail($id);
//
//        $image = $request->file('file');
//        $imageName = $image->getClientOriginalName();
//        $image->move(public_path('assets/product'),$imageName);
//
//        DB::table('product_image')->insert([
//            'product_id' => $product->id,
//            'product_image' => $imageName,
//            'created_at' => Carbon::now(),
//            'updated_at' => Carbon::now()
//        ]);
//
//        return response()->json(['success'=>$imageName]);

        if ($request->isMethod('post')) {

            //create product Image

            if ($request->file('file'))
            {
                $product = Product::findOrFail($id);

                foreach ($request->file('file') as $value)
                {
                    //dd($value);
                    $image_tmp = $value;
                    $name=$value->getClientOriginalName();
                    $filename = $name;

                    $original_image_path = public_path().'/assets/product/original/'.$filename;
                    $large_path = public_path().'/assets/product/large/'.$filename;
                    $medium_image_path = public_path().'/assets/product/medium/'.$filename;
                    $small_image_path = public_path().'/assets/product/small/'.$filename;

                    //Resize Image
                    Image::make($image_tmp)->save($original_image_path);
                    Image::make($image_tmp)->resize(1920,680)->save($large_path);
                    Image::make($image_tmp)->resize(1000,529)->save($medium_image_path);
                    Image::make($image_tmp)->resize(500,529)->save($small_image_path);

                    //$value->move(public_path().'/assets/admin/uploads/product_images/original/'.$name);

                    DB::table('product_image')->insert([
                        'product_id' => $product->id,
                        'product_image' => $filename,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }

            return \response()->json([
                'message' => 'Product Image Added Successful',
                'status_code' => 200
            ], Response::HTTP_OK);

        }
    }

    public function image_edit($id)
    {
        $product_image = DB::table('product_image')->where('product_image.id', $id)->first();

        return view('admin.product.product_image.edit', compact('product_image'));
    }

    public function image_update(Request $request, $id)
    {
        if ($request->isMethod('post')) {

            //create product Image

            if ($request->file('product_image'))
            {
                $product =   DB::table('product_image')->where('product_image.id', $id)->first();

                //dd($value);
                $image_tmp = $request->file('product_image');
                $name=$image_tmp->getClientOriginalName();
                $filename = $name;

                $original_image_path = public_path().'/assets/product/original/'.$filename;
                $large_path = public_path().'/assets/product/large/'.$filename;
                $medium_image_path = public_path().'/assets/product/medium/'.$filename;
                $small_image_path = public_path().'/assets/product/small/'.$filename;

                //Resize Image
                Image::make($image_tmp)->save($original_image_path);
                Image::make($image_tmp)->resize(1920,680)->save($large_path);
                Image::make($image_tmp)->resize(1000,529)->save($medium_image_path);
                Image::make($image_tmp)->resize(500,529)->save($small_image_path);

                DB::table('product_image')->where('product_image.id', $id)->update([
                    'product_id' => $product->product_id,
                    'product_image' => $filename,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

            }

            return \response()->json([
                'message' => 'Product Image Updated Successful',
                'status_code' => 200
            ], Response::HTTP_OK);

        }
    }

    public function edit_delete_image($id)
    {
        $product_images = DB::table('product_image')->where('product_image.id', $id)->first();

        if ($product_images->product_image != null)
        {
            $original = public_path().'/assets/product/original/'.$product_images->product_image;
            $large = public_path().'/assets/product/large/'.$product_images->product_image;
            $medium = public_path().'/assets/product/medium/'.$product_images->product_image;
            $small = public_path().'/assets/product/small/'.$product_images->product_image;

            unlink($original);
            unlink($large);
            unlink($medium);
            unlink($small);

        }

        DB::table('product_image')->where('product_image.id', $id)->update(['product_image' => null]);

        return response()->json([
            'message' => 'Product Image Destroy Successful',
            'status_code' => 200
        ], 200);
    }

    public function image_delete(Request $request)
    {
        $filename =  $request->get('filename');

        $product_images = DB::table('product_image')->where('product_image',$filename)->first();

        if ($product_images->product_image != null)
        {
            $original = public_path().'/assets/product/original/'.$product_images->product_image;
            $large = public_path().'/assets/product/large/'.$product_images->product_image;
            $medium = public_path().'/assets/product/medium/'.$product_images->product_image;
            $small = public_path().'/assets/product/small/'.$product_images->product_image;

            unlink($original);
            unlink($large);
            unlink($medium);
            unlink($small);

        }

        DB::table('product_image')->where('product_image.id', $product_images->id)->delete();

        return response()->json([
            'message' => 'Product Image Remove',
            'status_code' => 200
        ], 200);
    }

    public function image_destroy($id)
    {
        $product_images = DB::table('product_image')->where('product_image.id', $id)->first();

        if ($product_images->product_image != null)
        {
            $original = public_path().'/assets/product/original/'.$product_images->product_image;
            $large = public_path().'/assets/product/large/'.$product_images->product_image;
            $medium = public_path().'/assets/product/medium/'.$product_images->product_image;
            $small = public_path().'/assets/product/small/'.$product_images->product_image;

            unlink($original);
            unlink($large);
            unlink($medium);
            unlink($small);

        }

        DB::table('product_image')->where('product_image.id', $id)->delete();

        return response()->json([
            'message' => 'Product Image Destroy Successful',
            'status_code' => 200
        ], 200);
    }

}
