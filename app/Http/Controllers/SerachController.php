<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SerachController extends Controller
{
    public function Search(Request $request){
        $search = $request->search;
        // dd($search);
        $products = DB::table('products')
        ->where('product_name','LIKE',"%$search%")
        ->paginate(20);

        return view('pages.search',compact('products')); 
    }
}
