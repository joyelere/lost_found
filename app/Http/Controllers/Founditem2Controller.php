<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\founditem;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Founditem2Controller extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }
    public function index(){
        $founditems = DB::table('founditems')->latest('id')->paginate(12);
        // return view('founditem.index')->with('founditems',$founditems);
        return view('founditem.index',['founditems'=> $founditems]);
      
        // return view('articles.index',['articles'=>$articles]);
        // return view('welcome',compact('documents'));
    }
}
