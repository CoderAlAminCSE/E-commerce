<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class WishlistController extends Controller
{
    public function AddWishlist($id){
        $userid = Auth::id();
        $check = DB::table('wishlists')->where('user_id',$userid)->where('product_id',$id)->first();

        $data = array(
            'user_id' => $userid,
            'product_id' => $id,
        
            );

        if (Auth::Check()) {
            
            if ($check) {
                return \Response::json(['error' => 'Product Already Has on your wishlist']);	 
            }else{
                DB::table('wishlists')->insert($data);
                return \Response::json(['success' => 'Product Added on wishlist']);
            }     
            }else{
                return \Response::json(['error' => 'At first loing your account']);      

            }
    }



    public function ViewWishList(){
        $userid = Auth::id();
        $product = DB::table('wishlists')
                ->join('products','wishlists.product_id','products.id')
                ->select('products.*','wishlists.user_id')
                ->where('wishlists.user_id',$userid)
                ->get();
               // return response()->json($product);
                return view('pages.wishlist',compact('product'));
    }




}
