<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $guarded = [];

    public static function getViewProduct($id)
    {
        $product = DB::table('products')
            ->select(
                'products.*',
                'catgeories.name as cat_name',
                'brands.name as brand_name'
            )
            ->join('catgeories','products.category_id','=','catgeories.id')
            ->join('brands','products.brand_id','=','brands.id')
            ->where('products.id', $id)
            ->first();

        return $product;
    }

    public static function getAllProducts()
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
            ->paginate(8)
            ->all();

        return $product;
    }

    public static function getRelatedProducts($category_id, $sub_cat_id)
    {
        $product = DB::table('products')
                    ->select(
                        'products.id as id',
                        'products.category_id as category_id',
                        'products.sub_cat_id as sub_cat_id',
                        'products.name as name',
                        'products.title as title',
                        'products.image as image',
                        'products.price as price',
                        'catgeories.name as cat_name',
                        'sub_categories.name as sub_cat_name'
                    )
                    ->join('catgeories','products.category_id','=','catgeories.id')
                    ->join('sub_categories','products.sub_cat_id','=','sub_categories.id')
                    ->orderBy('products.id','desc')
                    ->where('products.category_id', $category_id)
                    ->orWhere('products.sub_cat_id', $sub_cat_id)
                    ->limit(5)
                    ->get();

        return $product;
    }

    public static function getProductImage($id)
    {
        $product = DB::table('products')
            ->select(
                'products.*',
                'product_image.product_image as product_image'
            )
            ->join('product_image','products.id','=','product_image.product_id')
            ->where('products.id', $id)
            ->get();

        return $product;
    }

    public function category()
    {
        return $this->belongsTo('App\Catgeory','category_id','id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\SubCategory','sub_cat_id','id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand','brand_id','id');
    }
}
