<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryForm;
use App\Category;
use App\Product;
use carbon\carbon;
use Auth;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
  function addcategory(){
    return view('admin.category.addcategory',[
      'categories'=> category::all(),
      'deleted_categories'=>category::onlyTrashed()->get()
    ]);
  }
  function addcategorypost(CategoryForm $request){
         $category_id = Category::insertGetId([
              'category_name' => $request->category_name,
              'category_description' => $request->category_description,
              'user_id' =>Auth::id(),
              'created_at'=>carbon::now()
         ]);
         if ($request->hasFile('category_photo')) {

           $uploaded_photo = $request->file('category_photo');
           $new_photo_name = $category_id.".".$uploaded_photo->getClientOriginalExtension();
           $new_phpto_location = 'public/uploads/category_photos/'.$new_photo_name;
           Image::make($uploaded_photo)->resize(150,150)->save(base_path($new_phpto_location));
           Category::find($category_id)->update([
             'category_photo' => $new_photo_name
           ]);
           return back();
         }
         return back()->with('success_status', $request->category_name. ' category insert successfully !!!! ');
  }
  function deletecategory($category_id){
    Category::find($category_id)->delete();
    Product::where('category_id', $category_id)->delete();
    return back()->with('delete_status' , 'your category delete successfully');
  }
    function editcategory($category_id){
      return view('admin.category.edit',[
        'category_info' => category::find($category_id)
      ]);
    }
    function editcategorypost(Request $request){
      $request->validate([
     'category_name'=> 'unique:categories,category_name,'.$request->category_id
      ]);
      Category::find( $request->category_id)->update([
          'category_name'=>$request->category_name,
          'category_description'=>$request->category_description
      ]);
      //return back()->with('edit_status', 'Your edit status edited successfully  !!!!');
      return redirect('addcategory')->with('edit_status', 'Your edit status edited successfully  !!!!');
    }
    function restorecategory($category_id){
      Category::withTrashed()->find($category_id)->restore();
          return back()->with('restore_status', 'Your category restore successfully  !!!!');
    }
    function forcecdeleteategory($category_id){
      Category::withTrashed()->find($category_id)->forceDelete();
          return back()->with('force_delete_status', 'Your category permanent delete successfully  !!!!');
    }
    function markdelete(Request $request){
      if (isset($request->category_id)) {
        foreach ($request->category_id as $cat_id) {
          Category::find($cat_id)->delete();
        }
      }
       return back();
    }
    function markrestore(Request $request){
      if (isset($request->category_id)) {
        foreach ($request->category_id as $cat_id) {
            Category::withTrashed()->find($cat_id)->restore();
        }
      }
       return back();
    }
}
