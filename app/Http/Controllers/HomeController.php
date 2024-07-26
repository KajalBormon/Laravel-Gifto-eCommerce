<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index(){
        $user = User::where('usertype','user')->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $delivered = Order::where('status','Delivered')->get()->count();
        return view('admin.index',compact('user','product','order','delivered'));
    }

    public function home(){
        $products = Product::all();
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id', $user_id)->count();
        }else{
            $count = '';
        }
        return view('home.index',compact('products','count'));
    }

    public function home_login(){
        $products = Product::all();
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id', $user_id)->count();
        }else{
            $count = '';
        }
        return view('home.index',compact('products','count'));
    }

    public function product_details($id){
        $data = Product::find($id);
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id', $user_id)->count();
        }else{
            $count = '';
        }
        return view('home.product_details',compact('data','count'));
    }

    public function add_cart($id){
        $product_id = $id;
        $user_id = Auth::user()->id;

        Cart::create([
            'user_id' => $user_id,
            'product_id' => $product_id
        ]); 

        return redirect()->back()->with('status','Add to Cart Successfully');
    }

    public function mycart(){

        $user_id = Auth::user()->id;
        $count = Cart::where('user_id', $user_id)->count();
        
        $cart = Cart::where('user_id',$user_id)->get();

        return view('home.mycart',compact('cart','count'));
    }

    public function cart_delete($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
 
    public function cart_order(Request $request){
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id',$user_id)->get();
        foreach($carts as $cart){
            Order::create([
                'name' => $request->name,
                'rec_add' => $request->address,
                'phone' => $request->phone,
                'user_id' => $user_id,
                'product_id' => $cart->product_id
            ]);
        }
        return redirect()->back()->with('status','Order Placed successfully');
    } 

    public function myorder(){
        $user_id = Auth::user()->id;
        $count = Cart::where('user_id',$user_id)->get()->count();
        $orders = Order::where('user_id',$user_id)->get();
        return view('home.myorder',compact('count','orders'));

    }

    public function stripe($value){
        return view('home.stripe',compact('value'));
    }

    public function stripePost(Request $request, $value)
    {
        Stripe\stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from Complete." 
        ]);
        $user_name = Auth::user()->name;
        $phone = Auth::user()->phone;
        $add = Auth::user()->address;
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id',$user_id)->get();
        foreach($carts as $cart){
            Order::create([
                'name' => $user_name,
                'rec_add' => $add,
                'phone' =>  $phone,
                'user_id' => $user_id,
                'product_id' => $cart->product_id,
                'payment_status' => 'Paid'
            ]);
        }
        return redirect()->back()->with('status','Order Placed successfully');
    }
}
