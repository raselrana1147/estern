<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Catgeory;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Slider;
use Auth;
use Session;

class EcommerceController extends Controller
{
    public function index()
    {
        $category = Catgeory::latest()->get();

        $sub_category = SubCategory::latest()->get();

        $products = Product::with('category','brand','subcategory')->latest()->paginate(8);

        $slide_proeuct = Product::get()->random(4);

        $all_products = Product::with('category','brand','subcategory')->where('new_arrival','=',1)->latest()->get();

        //dd($all_products);

        $brand = Brand::latest()->get();

        $sliders=Slider::where('status','1')->orderBy('id','DESC')->get();
        

        $feature_product = Product::where('feature',1)->latest()->get()->random(3);

        $sale_product = Product::where('new_arrival',1)->latest()->get()->random(3);

        $top_product = Product::where('view_count','>=', 100)->latest()->get()->random(3);

        return view('welcome', compact('category','sub_category','products','slide_proeuct','all_products','brand','feature_product','sale_product','top_product','sliders'));
    }

    public function details($id)
    {
         
        $category = Catgeory::latest()->get();

        $sub_category = SubCategory::latest()->get();

        $brand = Brand::latest()->get();

        $feature_product = Product::where('feature',1)->latest()->get()->random(3);

        $sale_product = Product::where('new_arrival',1)->latest()->get()->random(3);

        $top_product = Product::where('view_count','>=', 100)->latest()->get()->random(3);


        $product = Product::with('category','brand','subcategory')->where('id', $id)->first();
        $total_view=$product->view_count;
        $product->view_count += $total_view;
        $product->save();

        $related_product = Product::getRelatedProducts($product->cateory_id, $product->sub_cat_id);

        $product_image = Product::getProductImage($product->id);

        return view('details', compact('category','sub_category','brand','feature_product','sale_product','top_product','product','related_product','product_image'));
    }


    public function loadMoreDataCat(Request $request){
       $products=Product::where('category_id',$request->categoryid)
                ->offset($request['start'])
                ->limit($request['limit'])->orderBy('id','DESC')
                ->get();
                  $setProduct='';
         if (count($products)>0) {
            foreach ($products as $product) {
               $setProduct.='<li class="product">
                                                
                                  <div class="product-outer">
                                      <div class="product-inner">
                                          <span class="loop-product-categories"><a href="'.route('details',$product->id).'" rel="tag">'. $product->category->name.'</a></span>
                                          <a href="'.route('details',$product->id).'">
                                              <h3>'.$product->title.'</h3>
                                              <div class="product-thumbnail">
                                                
                                                  <img src="'.asset('assets/uploads/small/'.$product->image).'" class="img-responsive" alt="" width="250px" height="232px">
                                                    
                                              </div>
                                          </a>

                                          <div class="price-add-to-cart">
                                  <span class="price">
                                      <span class="electro-price">
                                          <ins><span class="amount"> &#2547;'.$product->price.'</span></ins>
                                          <span class="amount"> </span>
                                      </span>
                                  </span>'.((Session::get("CustomerSession") !="") ? '<a rel="nofollow" href="javascript:;" class="button add_to_cart_button add_to_cart_product" product_id="'.$product->id.'" add_type="1" data-action="'.route('add.to.cart').'">Add to cart</a>': '<a rel="nofollow" href="'.route('customer.login').'" class="button add_to_cart_button">Add to cart</a>').'
                                    </div>

                                          <div class="hover-area">
                                              <div class="action-buttons">
                                                  <a href="'.route('details','').'/'.$product->id.'"><i class="fa fa-sign-in" style="color: red;"></i> Details</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                              </li>';
            }
         }else{
           $setProduct.='';
         }

        echo $setProduct;

    }


     public function loadMoreDataBrand(Request $request){
       $products=Product::where('brand_id',$request->brandid)
                ->offset($request['start'])
                ->limit($request['limit'])->orderBy('id','DESC')
                ->get();
                  $setProduct='';
         if (count($products)>0) {
            foreach ($products as $product) {
               $setProduct.='<li class="product">
                                                
                                  <div class="product-outer">
                                      <div class="product-inner">
                                          <span class="loop-product-categories"><a href="'.route('details',$product->id).'" rel="tag">'. $product->category->name.'</a></span>
                                          <a href="'.route('details',$product->id).'">
                                              <h3>'.$product->title.'</h3>
                                              <div class="product-thumbnail">
                                                
                                                  <img src="'.asset('assets/uploads/small/'.$product->image).'" class="img-responsive" alt="" width="250px" height="232px">
                                                    
                                              </div>
                                          </a>

                                          <div class="price-add-to-cart">
                                  <span class="price">
                                      <span class="electro-price">
                                          <ins><span class="amount"> &#2547;'.$product->price.'</span></ins>
                                          <span class="amount"> </span>
                                      </span>
                                  </span>
                                             '.((Session::get("CustomerSession") !="") ? '<a rel="nofollow" href="javascript:;" class="button add_to_cart_button add_to_cart_product" product_id="'.$product->id.'" add_type="1" data-action="'.route('add.to.cart').'">Add to cart</a>': '<a rel="nofollow" href="'.route('customer.login').'" class="button add_to_cart_button">Add to cart</a>').'
                                          </div>

                                          <div class="hover-area">
                                              <div class="action-buttons">
                                                  <a href="'.route('details','').'/'.$product->id.'"><i class="fa fa-sign-in" style="color: red;"></i> Details</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                              </li>';
            }
         }else{
           $setProduct.='';
         }

        echo $setProduct;
    }

     public function loadMoreDataSubCat(Request $request){
       $products=Product::where('sub_cat_id',$request->subcat_id)
                ->offset($request['start'])
                ->limit($request['limit'])->orderBy('id','DESC')
                ->get();
                  $setProduct='';
         if (count($products)>0) {
            foreach ($products as $product) {
               $setProduct.='<li class="product">
                                                
                                  <div class="product-outer">
                                      <div class="product-inner">
                                          <span class="loop-product-categories"><a href="'.route('details',$product->id).'" rel="tag">'. $product->category->name.'</a></span>
                                          <a href="'.route('details',$product->id).'">
                                              <h3>'.$product->title.'</h3>
                                              <div class="product-thumbnail">
                                                
                                                  <img src="'.asset('assets/uploads/small/'.$product->image).'" class="img-responsive" alt="" width="250px" height="232px">
                                                    
                                              </div>
                                          </a>

                                          <div class="price-add-to-cart">
                                  <span class="price">
                                      <span class="electro-price">
                                          <ins><span class="amount"> &#2547;'.$product->price.'</span></ins>
                                          <span class="amount"> </span>
                                      </span>
                                  </span>
                                            '.((Session::get("CustomerSession") !="") ? '<a rel="nofollow" href="javascript:;" class="button add_to_cart_button add_to_cart_product" product_id="'.$product->id.'" add_type="1" data-action="'.route('add.to.cart').'">Add to cart</a>': '<a rel="nofollow" href="'.route('customer.login').'" class="button add_to_cart_button">Add to cart</a>').'
                                          </div>

                                          <div class="hover-area">
                                              <div class="action-buttons">
                                                  <a href="'.route('details','').'/'.$product->id.'"><i class="fa fa-sign-in" style="color: red;"></i> Details</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                              </li>';
            }
         }else{
           $setProduct.='';
         }

        echo $setProduct;

    }



    public function product_category($id){
        $category     = Catgeory::latest()->get();
        $sub_category = SubCategory::latest()->get();
        $brand        = Brand::latest()->get();
        $single_cat=Catgeory::findORFail($id);
        $products=Product::where('category_id',$id)->orderBY('id','DESC')->simplePaginate(4);

        $feature_product = Product::where('feature',1)->latest()->get()->random(3);

        $sale_product = Product::where('new_arrival',1)->latest()->get()->random(3);

        $top_product = Product::where('view_count','>=', 100)->latest()->get()->random(3);


        return view('product_category',compact('category','brand','sub_category','single_cat','products','feature_product','sale_product','top_product'));

    }

    
   public function product_subcategory($id){

        $category     = Catgeory::latest()->get();
        $sub_category = SubCategory::latest()->get();
        $brand        = Brand::latest()->get();
        $single_scat=SubCategory::findORFail($id);
        $products=Product::where('sub_cat_id',$id)->orderBY('id','DESC')->paginate(4);

        $feature_product = Product::where('feature',1)->latest()->get()->random(3);

        $sale_product = Product::where('new_arrival',1)->latest()->get()->random(3);

        $top_product = Product::where('view_count','>=', 100)->latest()->get()->random(3);


        return view('product_sub_category',compact('category','brand','sub_category','single_scat','products','feature_product','sale_product','top_product'));

    }

    public function product_brand($id){

        $category     = Catgeory::latest()->get();
        $sub_category = SubCategory::latest()->get();
        $brand        = Brand::latest()->get();
        $single_bcat=Brand::findORFail($id);
        $products=Product::where('brand_id',$id)->orderBY('id','DESC')->paginate(2);

        $feature_product = Product::where('feature',1)->latest()->get()->random(3);

        $sale_product = Product::where('new_arrival',1)->latest()->get()->random(3);

        $top_product = Product::where('view_count','>=', 100)->latest()->get()->random(3);


        return view('product_brand',compact('category','brand','sub_category','single_bcat','products','feature_product','sale_product','top_product'));

    }

    public function search_realtime_product(Request $request){
          if ($request->isMethod("post")) {
               $products= Product::where('name','LIKE','%'.$request->search_value.'%')->get();
               if (count($products)) {
                 $message=['status'=>'success', 'products'=>$products];
               }else{
                   $message=['status'=>'error', 'products'=>$products,'msg'=>'Nothing is found for this search'];
                }
          }
          echo json_encode($message);
    }

    public function search_product(Request $request){
        if ($request->isMethod('post')) {
        $category     = Catgeory::latest()->get();
        $sub_category = SubCategory::latest()->get();
        $brand        = Brand::latest()->get();
       
          if (!empty($request->category_id)) {
             $products= Product::where('name','LIKE','%'.$request->search.'%')
             ->orWhere('category_id',$request->category_id)
             ->get();
          }else{
              $products= Product::where('name','LIKE','%'.$request->search.'%')->get();
          }

        $feature_product = Product::where('feature',1)->latest()->get()->random(3);

        $sale_product = Product::where('new_arrival',1)->latest()->get()->random(3);

        $top_product = Product::where('view_count','>=', 100)->latest()->get()->random(3);


        return view('search',compact('category','brand','sub_category','products','feature_product','sale_product','top_product'));
      }else{
          return redirect(route('ecommerce'));
      }
    }

    public function privacy_policy()
    {
        $brand = Brand::latest()->get();
        $feature_product = Product::where('feature',1)->latest()->get()->random(3);
        $sale_product = Product::where('new_arrival',1)->latest()->get()->random(3);
        $top_product = Product::where('view_count','>=', 100)->latest()->get()->random(3);
        $category = Catgeory::latest()->get();
        $sub_category = SubCategory::latest()->get();
       return view('privacy_policy',compact('brand','feature_product','sale_product','top_product','category','sub_category'));
    }
}
