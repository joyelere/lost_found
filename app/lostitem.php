<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lostitem extends Model
{
    //
    //  protected $table = "lostitems";
    protected $fillable=['Title','Phone_number','Address','Category','Date','Description'];
    protected $dates=['Date'];
    public $timestamps = false;
    // protected $dates=['Date'];
    public function author(){
        return $this->belongsTO(User::class,'user_id');
    }
}
