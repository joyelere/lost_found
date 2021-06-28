<?php

namespace App\Http\Controllers;

use App\User;
use App\lostitem;
use App\founditem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }


    public function index()
    {
        $lostitem=lostitem::where('user_id', '=', Auth::user()->id)->get();
        $founditem=founditem::where('user_id', '=', Auth::user()->id)->get();
        return view('auth.profile',compact('lostitem','founditem'));
    }


    public function destory($id){
        // delete the resource
        $lostitem=lostitem::find($id);
        // dd($document);
        $lostitem->delete();
        return redirect()->back()->with('success','data deleted');
       }


    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }
    public function updateProfile(Request $request)
    {
        // Form validation
        $request->validate([
            'name'              =>  'required',
            'profile_image'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Get current user
        $user = User::findOrFail(auth()->user()->id);
        // Set user name
        $user->name = $request->input('name');

        // Check if a profile image has been uploaded
        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
        }
        // Persist user record to database
        $user->save();

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }

    public function destory2($id){
        // delete the resource
        $founditem=founditem::find($id);
        // dd($document);
        $founditem->delete();
        return redirect()->back()->with('success','data deleted');
       }
}
