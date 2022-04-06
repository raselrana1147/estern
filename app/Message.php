<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    
    protected $guarded=[];

    // parent relation
        public function parent(){

           return $this->belongsTo(self::class , 'parent_id');
       }
       //sub relation
        public function replies()
       {
           return $this->hasMany(self::class ,'parent_id');
       }

      public function user()
      {
         return $this->belongsTo("App\User");
      }
}
