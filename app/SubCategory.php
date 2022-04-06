<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubCategory extends Model
{
    protected $guarded = [];

    public static function getEditSubCategory($id)
    {
        $subCategory = DB::table('sub_categories')
                        ->select(
                            'sub_categories.*',
                            'catgeories.name as cat_name'
                        )
                        ->join('catgeories','sub_categories.category_id','=','catgeories.id')
                        ->where('sub_categories.id',$id)
                        ->first();
        return $subCategory;
    }

    public static function getAllSubCategory()
    {
        $subCategory = DB::table('sub_categories')
                        ->select(
                            'sub_categories.*',
                            'catgeories.name as cat_name'
                        )
                        ->join('catgeories','sub_categories.category_id','=','catgeories.id')
                        ->orderBy('sub_categories.id','desc')
                        ->get();

        return $subCategory;
    }

    public function product()
    {
        return $this->hasMany('App\SubCategory','sub_cat_id','id');
    }

    public function cat()
    {
        return $this->belongsTo('App\Catgeory','category_id','id');
    }
}
