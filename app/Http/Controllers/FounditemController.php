<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\founditem;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FounditemController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function show(founditem $founditem){
        $users = User::where('id', '=', $founditem->user_id)->where('id', '!=', Auth::user()->id)->get();
        return view('founditem.show', compact('users','founditem'));
    }
    
    public function create(){
       
        return view('founditem.create');
    }
    
    public function store(Request $request)
    {
      $this->ValidatedAttributes();
  
     $founditem=new founditem(request(['Title','Phone_number','Address','Category','Date','Description']));
     $founditem->user_id=Auth::id();
   
      if($request->hasfile('file')){
          $image =$request->file('file');
          $image_size =$image->getClientSize();
          $image_ext =$image->getClientOriginalExtension();
          $new_image=rand(123456,999999).".".$image_ext;
          $destination_path =public_path('/foundimages');
          $image->move($destination_path,$new_image);

          $founditem->image=$new_image;
          
          if($founditem->save()){
        return redirect()->back()->with('msg','Great! file has been successfully uploaded.');
   
       }
      }else{
          $founditem->save();
          return back()->with('msg','Great! file has been successfully uploaded.');
      }
   }

       protected function ValidatedAttributes(){

           return  request()->validate([
            'file'  => 'mimes:jpeg,png|max:2048',
            'Title' => 'required',
             'Phone_number'=> 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Address'=>'required',
             'Category'=>'required',
            'Date' =>'required',
             'Description' =>'required'
       ]);
       }
    }

