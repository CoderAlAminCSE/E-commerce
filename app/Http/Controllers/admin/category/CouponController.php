<?php

namespace App\Http\Controllers\admin\category;

use App\Http\Controllers\Controller;
use App\Models\coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function CouponView(){
        $allData = coupon::all();
        return view('admin.coupon.coupon_view',compact('allData'));
    }


    public function CouponStore(Request $request){
        $validatedData = $request->validate([
            'coupon'=>'required|unique:coupons|max:55',
        ]);

        $data = new coupon();
        $data->coupon = $request->coupon;
        $data->discount = $request->discount;
        $data->save();

        $notification=array(
            'messege' => 'Coupon Added Succesfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function CouponDelete($id){
        $deleteData = coupon::find($id);
        $deleteData->delete();

        $notification=array(
            'messege' => 'Coupon Delete Succesfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function CouponEdit($id){
        $editData = coupon::find($id);
        return view('admin.coupon.coupon_edit',compact('editData'));
    }


    public function CouponUpdate(Request $request,$id){
        $validatedData = $request->validate([
            'coupon'=>'required|unique:coupons|max:55',
        ]);

        $data =coupon::find($id);
        if($request->coupon!=null){
            $data->coupon = $request->coupon;
            $data->discount = $request->discount;
            $data->update();
    
            $notification=array(
                'messege' => 'Coupon Update Succesfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('coupon.view')->with($notification);
        }
      
    }


}
