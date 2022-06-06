<?php

namespace App\Http\Controllers\admin\category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function CategoryView(){
        $allData = Category::all();
        return view('admin.category.category_view',compact('allData'));
    }


    public function CategoryStore(Request $request){
        $validatedData = $request->validate([
            'category_name'=>'required|unique:categories|max:255',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        $notification=array(
            'messege' => 'Category Added Succesfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function CategoryDelete($id){
        $deleteData = Category::find($id);
        $deleteData->delete();

        $notification=array(
            'messege' => 'Category Delete Succesfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function CategoryEdit($id){
        $editData = Category::find($id);
        return view('admin.category.category_edit',compact('editData'));
    }


    public function CategoryUpdate(Request $request, $id){
        $validatedData = $request->validate([
            'category_name'=>'required|unique:categories|max:255',
        ]);
        
        $data = Category::find($id);
        $data->category_name = $request->category_name;
        $data->save();
        $notification=array(
            'messege' => 'Category Updated Succesfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('category.view')->with($notification);
    }
}
