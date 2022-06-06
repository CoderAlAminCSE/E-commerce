<?php

namespace App\Http\Controllers\admin\category;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function BrandView(){
        $allData = Brand::all();
        return view('admin.category.brand_view',compact('allData'));
    }


    public function BrandStore(Request $request){
        $validatedData = $request->validate([
            'brand_name'=>'required|unique:brands|max:255',
        ]);

        $data = new Brand();
        $data->brand_name = $request->brand_name;
        $data->brand_logo = $request->brand_logo;
        if($request->file('brand_logo')){
            $file=$request->file('brand_logo');
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/brands'),$filename);
            $data['brand_logo']=$filename;

            $data->save();
            $notification=array(
                'messege' => 'Brand Inserted Succesfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('brands.view')->with($notification);
        }else{
            $data->save();
            $notification=array(
                'messege' => 'Brand Inserted Succesfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('brands.view')->with($notification);
        }
    }


    public function BrandDelete($id){
        $data = Brand::findOrFail($id);
        // dd($data);
        if($data->brand_logo == null){
            $data->delete();
            $notification=array(
                'messege' => 'Delete Succesfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('brands.view')->with($notification);
        }else{
            unlink(public_path().'\upload\brands\\'.$data->brand_logo);
            $data->delete();
            $notification=array(
                'messege' => 'Delete Succesfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('brands.view')->with($notification);
        }
    }


    public function BrandEdit($id){
        $editData = Brand::find($id);
        return view('admin.category.brand_edit',compact('editData'));
    }


    public function BrandUpdate(Request $request,$id){
     
        // $validatedData = $request->validate([
        //     'brand_name'=>'required|unique:brands|max:255',
        // ]);

        $data =  Brand::find($id);
        // $data->brand_name = $request->brand_name;
        // dd($data);
        $old_logo = $request->old_logo;
        if($old_logo!=null){
            if($request->file('brand_logo')!=null){
                $file=$request->file('brand_logo');
                $data->brand_name = $request->brand_name;
                $filename=date('YmdHi').$file->getClientOriginalName();
                unlink(public_path().'\upload\brands\\'.$old_logo);
                $file->move(public_path('upload/brands'),$filename);
                $data['brand_logo']=$filename;
    
                $data->update();
                $notification=array(
                    'messege' => 'Brand Updated Succesfully',
                    'alert-type' => 'success'
                );
                return Redirect()->route('brands.view')->with($notification);
            }
            else{
                $data->brand_name = $request->brand_name;
                $data->update();
                $notification=array(
                    'messege' => 'Brand Update Succesfully',
                    'alert-type' => 'success'
                );
                return Redirect()->route('brands.view')->with($notification);
            }
       
        }
        else{
            if($request->file('brand_logo')!=null){
                $file=$request->file('brand_logo');
                $data->brand_name = $request->brand_name;
                $filename=date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/brands'),$filename);
                $data['brand_logo']=$filename;
    
                $data->update();
                $notification=array(
                    'messege' => 'Brand Updated Succesfully',
                    'alert-type' => 'success'
                );
                return Redirect()->route('brands.view')->with($notification);
            }else{
                $data->brand_name = $request->brand_name;
                $data->update();
                $notification=array(
                    'messege' => 'Brand Update Succesfully',
                    'alert-type' => 'success'
                );
                return Redirect()->route('brands.view')->with($notification);
            }
        }
    }
    
    





}
