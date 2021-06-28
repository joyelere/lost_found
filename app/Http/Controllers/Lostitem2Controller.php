<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lostitem;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Lostitem2Controller extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }
    //
    public function index(){
        $lostitems = DB::table('lostitems')->latest('id')->paginate(12);
        // return view('lostitem.index')->with('lostitems',$lostitems);
        return view('lostitem.index',['lostitems'=> $lostitems]);
      
        // return view('articles.index',['articles'=>$articles]);
        // return view('welcome',compact('documents'));
    }
  
    
   
}
