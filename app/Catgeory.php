<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catgeory extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->hasMany('App\Product','category_id','id');
    }

    public function subcat()
    {
        return $this->hasMany('App\SubCategory','category_id','id');
    }
}
