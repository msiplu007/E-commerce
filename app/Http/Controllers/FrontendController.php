<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Product;
use Auth;
use App\Contact;
use Hash;
use Carbon\Carbon;
class FrontendController extends Controller
{

  function index(){
    return view('frontend.index',[
      'active_products' => Product::latest()->get(),
      'active_categories' => Category::all()
    ]);
  }
  function productdetails($slug){
    return view('frontend.productdetails',[
      'product_info' =>   Product::where('slug', $slug)->firstOrFail()
    ]);
  }
  function contact(){
    return view('frontend.contact');
  }
  function contactinsert(Request $request){
    $contact_id = Contact::insertGetId($request->except('_token') + [
      'created_at' => Carbon::now()
    ]);
    if ($request->hasFile('contact_attectment')) {
    //  $uploaded_path = $request->file('contact_attectment')->store('contact_uploads');
      $path = $request->file('contact_attectment')->storeAs(
    'contact_uploads', $contact_id.".".$request->file('contact_attectment')->getClientOriginalExtension()
      );
      Contact::find($contact_id)->update([
        'contact_attectment' => $path
      ]);
    }
    return back()->with('contact_success' , 'Your contact message intered successfully ...');
  }
  function blog(){
    return view('blog');
  }
  function shop(){
    return view('frontend.shop',[
      'categories' => Category::all(),
      'products' => Product::all()
        ]);
  }
  function customerregister(){
    return view('frontend.customerregister');
  }
  function customerregisterpost(Request $request){
    User::insert([
       'name' => $request->name,
       'email' => $request->email,
       'role' => 2,
       'password' =>Hash::make($request->password),
       'created_at' => Carbon::now()
    ]);
   if(Auth::attempt(['email'=>$request->email, 'password' => $request->password])){
       return redirect ('customer/home');
   }
   return back();
  }
}
