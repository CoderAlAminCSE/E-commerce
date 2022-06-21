<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function SiteSetting(){
        $setting = DB::table('site_settings')->first();
        return view('admin.setting.site_setting',compact('setting'));
    }

    public function UpdateSiteSetting(Request $request){
        $id = $request->id;

        $data = array();
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['email'] = $request->email;
        $data['company_name'] = $request->company_name;
        $data['company_address'] = $request->company_address;
        $data['facebook'] = $request->facebook;
        $data['youtube'] = $request->youtube;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;
        DB::table('site_settings')->where('id',$id)->update($data);
        $notification=array(
               'messege'=>'Site Setting Updated Successfully',
               'alert-type'=>'success'
                );
              return Redirect()->back()->with($notification); 
    }
}
