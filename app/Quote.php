<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quote extends Model
{
    protected $guarded = [];

    public $timestamps = true;

    public static function getAllQuoteOrder()
    {
        $quote = DB::table('quotes')
                    ->select(
                        'quotes.id as id',
                        'stock_categories.stock_category_name as stock_category_name',
                        'stock_brands.stock_brand_name as stock_brand_name',
                        'stock_models.model_name as model_name',
                        'users.name as name',
                        'quotes.problem_details as details',
                        'quotes.phone as phone',
                        'quotes.status as status'
                    )
                    ->join('stock_categories','quotes.stock_category_id','=','stock_categories.id')
                    ->join('stock_brands','quotes.stock_brand_id','=','stock_brands.id')
                    ->join('stock_models','quotes.stock_model_id','=','stock_models.id')
                    ->join('users','quotes.user_id','=','users.id')
                    ->orderBy('quotes.id','desc')
                    ->get();

        return $quote;
    }
}
