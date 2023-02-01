<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

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

            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            $cart->price = $product->price;
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;
            $cart->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
}
