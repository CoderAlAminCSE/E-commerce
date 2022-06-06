<?php

namespace App\Http\Controllers\admin\category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCatController extends Controller
{
    public function SubCatView(){
        $category = DB::table('categories')->get();
        $subcat = DB::table('sub_categories')->join('categories','sub_categories.category_id','categories.id')->select('sub_categories.*','categories.category_name')->get();
        return view('admin.category.subcat_view',compact('category','subcat'));
    }


    public function SubCatStore(Request $request){
        $validatedData = $request->validate([
            'category_id'=>'required',
            'subcategory_name'=>'required'
        ]);

        $data = new SubCategory();
        $data->subcategory_name = $request->subcategory_name;
        $data->category_id = $request->category_id;
        $data->save();

        $notification=array(
            'messege' => 'SubCategory Added Succesfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function SubCatDelete($id){
        $deleteData = SubCategory::find($id);
        $deleteData->delete();

        $notification=array(
            'messege' => 'SubCategory Delete Succesfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function SubCatEdit($id){
        $editData = SubCategory::find($id);
        $category = Category::all();
        // dd($editData);
        return view('admin.category.subcategory_edit',compact('editData','category'));
    }


    public function SubCatUpdate(Request $request,$id){
        $validatedData = $request->validate([
            'category_id'=>'required',
            'subcategory_name'=>'required'
        ]);

        $data = SubCategory::find($id);
        $data->subcategory_name = $request->subcategory_name;
        $data->category_id = $request->category_id;
        $data->update();

        $notification=array(
            'messege' => 'SubCategory Updated Succesfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('subcategory_view.view')->with($notification);
    }
}
