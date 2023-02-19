<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Orders;
use Session;
use Stripe;


class HomeController extends Controller
{
    //

    public function index()
    {
        $product = Product::paginate(3);
        return view('home.user', compact('product'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 1) {
            return view('admin.home');
        } else {
            $product = Product::paginate(3);
            return view('home.user', compact('product'));
        }
    }

    public function product_detail($id)
    {
        $product = Product::find($id);
        return view('home.product-details', compact('product'));
    }

    public function addcart(Request $request)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $product = Product::find($request->pdt_id);

            $cart                = new Cart;
            $cart->name          = $user->name;
            $cart->email         = $user->email;
            $cart->phone         = $user->phone;
            $cart->address       = $user->address;
            $cart->user_id       = $user->id;
            $cart->product_title = $product->title;
            if ($product->discount_price != null) {
                $cart->price         = $product->discount_price * $request->quantity;
            } else {
                $cart->price         = $product->price * $request->quantity;
            }
            $cart->image         = $product->image;
            $cart->product_id    = $product->id;
            $cart->quantity      = $request->quantity;
            $cart->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', $id)->get();
            return view('home.showcart', compact('cart'));
        } else {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {

        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data = Cart::where('user_id', $user_id)->get();

        foreach ($data as $data) {

            $order                  = new Orders;
            $order->name            = $data->name;
            $order->email           = $data->email;
            $order->phone           = $data->phone;
            $order->address         = $data->address;
            $order->user_id         = $data->user_id;
            $order->product_title   = $data->product_title;
            $order->price           = $data->price;
            $order->quantity        = $data->quantity;
            $order->image           = $data->image;
            $order->product_id      = $data->product_id;
            $order->payment_status  = 'Cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        flash('We have received your order.We will connect soon', 'success');
        return redirect('show-cart');
    }

    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment"
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        $data = Cart::where('user_id', $user_id)->get();

        foreach ($data as $data) {

            $order                  = new Orders;
            $order->name            = $data->name;
            $order->email           = $data->email;
            $order->phone           = $data->phone;
            $order->address         = $data->address;
            $order->user_id         = $data->user_id;
            $order->product_title   = $data->product_title;
            $order->price           = $data->price;
            $order->quantity        = $data->quantity;
            $order->image           = $data->image;
            $order->product_id      = $data->product_id;
            $order->payment_status  = 'Paid';
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
