<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{
    public function Successlist(){
        $order = DB::table('orders')->where('user_id',Auth::id())->where('status',3)->orderBy('id','DESC')->limit(5)->get();
        return view('pages.returnorder',compact('order'));
    }


    public function RequestReturn($id){
        DB::table('orders')->where('id',$id)->update(['return_order'=>1]);
        $notification=array(
            'messege'=>'Order Request Done',
            'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
    }


    public function ReturnRequest(){
        $order = DB::table('orders')->where('return_order',1)->get();
        return view('admin.return.request',compact('order'));
    }


    public function ApprovedReturn($id){
    DB::table('orders')->where('id',$id)->update(['return_order'=>2]);
    $notification=array(
        'messege'=>'Order Return Success',
        'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function AllReturnRequest(){
        $order = DB::table('orders')->where('return_order',2)->get();
 	    return view('admin.return.all',compact('order'));
    }





}
