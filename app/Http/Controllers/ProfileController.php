<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Auth;
use Hash;
use Image;
use Mail;
use App\Mail\ChangePasswordMail;
class ProfileController extends Controller
{
    function profile(){
      return view('admin.profile.index');
    }
    function editprofilepost(Request $request){
      $request->validate([
        'name'=>'required'
      ]);
      if (Auth::user()->updated_at->addDays(2) < Carbon::now()) {
        User::find(Auth::id())->update([
          'name' => $request->name
        ]);
        return back()->with('name_status', 'Your name changed successfully  !!!!!!!!!');
      }
     else{
       $last_update = Carbon::now()->diffInDays(Auth::user()->updated_at->addDays(2));
       return back()->withErrors('You can change your name '. $last_update. ' days' );
     }
    }
    function editpasswordpost(Request $request){

         $request->validate([
           'password'=>'confirmed|min:8|alpha_num'
         ]);
      if (Hash::check($request->old_password, Auth::user()->password)) {
        if ($request->old_password == $request->password) {
          return back()->with('old_password', "Puran password aber kano !!!!!!!!!!");
        }
        else {
          User::find(Auth::id())->update([
            'password'=> Hash::make($request->password)
          ]);
          Mail::to(Auth::user()->email)->send(new ChangePasswordMail(Auth::user()->name));
          return back();

           // Send email
            echo "Success";
        }
       }
       else{
        return back()->with('old_password','Your password didi not match with database  !!!!!!!!!!');
       }
    }
    function changeprofilephoto(Request $request){
       $request->validate([
         'profile_photo' => 'required|image'
       ]);
      if ($request->hasFile('profile_photo')) {
        if (Auth::user()->profile_photo != 'default.png') {
          $old_photo_location = 'public/uploads/profile_photos/'.Auth::user()->profile_photo;
          unlink(base_path($old_photo_location));
        }
        $uploaded_photo = $request->file('profile_photo');
        $new_photo_name = Auth::id().".".$uploaded_photo->getClientOriginalExtension();
        $new_phpto_location = 'public/uploads/profile_photos/'.$new_photo_name;
        Image::make($uploaded_photo)->resize(150,150)->save(base_path($new_phpto_location));
        User::find(Auth::id())->update([
          'profile_photo' => $new_photo_name
        ]);
        return back();
      }
      else {
        echo "Nai";
      }
    }
}
