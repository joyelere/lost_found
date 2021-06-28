<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class founditem extends Model
{
    //
     //  protected $table = "founditems";
     protected $fillable=['Title','Phone_number','Address','Category','Date','Description'];
     protected $dates=['Date'];
     public $timestamps = false;
     // protected $dates=['Date'];
     public function authors(){
         return $this->belongsTO(User::class,'user_id');
     }
}
