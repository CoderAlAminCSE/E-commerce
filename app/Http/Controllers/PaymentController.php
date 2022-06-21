<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;
use Cart;

class PaymentController extends Controller
{
    public function Payment(Request $request){
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;
        // dd($data);

        if ($request->payment == 'stripe') {
    	
            return view('pages.payment.stripe',compact('data'));
        
            }elseif ($request->payment == 'paypal') {
                # code...
            }elseif ($request->payment == 'ideal') {
                # code...
            }else{
                echo "Cash On Delivery";
            } 
    }


    public function PaymentCharge(Request $request){
        $email = Auth::user()->email;
        $total = $request->total;
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51LCcJkCH6OXw34liRcl1diaqP7mQmZwTZycrOmhv3LW34l8rLOjY4lB5M4xRSw0SnNmD3ASNoW7vKMU9LZNCfnPN00GPtz1fKG');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total*100,
        'currency' => 'usd',
        'description' => 'Example charge',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);

        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_id'] = $charge->payment_method;
        $data['paying_amount'] = $charge->amount;
        $data['blnc_transection'] = $charge->balance_transaction;
        $data['stripe_order_id'] = $charge->metadata->order_id;
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payment_type'] = $request->payment_type;
        $data['status_code'] = mt_rand(100000,999999);
    
        if (Session::has('coupon')) {
            $data['subtotal'] = Session::get('coupon')['balance'];
        }else{
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);

        /// Insert Shipping Table 
        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shippings')->insert($shipping);


        // Insert Order Details Table
        $content = Cart::content();
        $details = array();
        foreach ($content as $row) {
        $details['order_id'] = $order_id;
        $details['product_id'] = $row->id;
        $details['product_name'] = $row->name;
        $details['color'] = $row->options->color;
        $details['size'] = $row->options->size;
        $details['quantity'] = $row->qty;
        $details['singleprice'] = $row->price;
        $details['totalprice'] = $row->qty*$row->price;
        DB::table('order_details')->insert($details); 
        }

        
        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification=array(
            'messege'=>'Order Process Successfully Done',
            'alert-type'=>'success'
                );
            return Redirect()->to('/')->with($notification);
    }
}
