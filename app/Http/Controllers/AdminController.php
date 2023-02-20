<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Product;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    //

    public function view_category()
    {
        $category_data = Category::get();
        return view('admin.category', compact('category_data'));
    }

    public function add_category(Request $request)
    {

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->save();
        flash('Category Stored Successfuly', 'success');
        return Redirect('/view-category');
    }

    public function delete_category($id)
    {
        $category_data = Category::find($id);
        $category_data->delete();
        flash('Category Deleted Successfuly', 'success');
        return Redirect('/view-category');
    }

    public function create_product()
    {
        $category_data = Category::get();
        return view('admin.product', compact('category_data'));
    }

    public function add_product(Request $request)
    {


        $product                 = new product;
        $product->title          = $request->title;
        $product->description    = $request->description;
        $product->category       = $request->category;
        $product->quantity       = $request->quantity;
        $product->price          = $request->price;
        $product->discount_price = $request->discount_price;
        $image =  $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image = $imagename;
        $product->save();
        flash('Product Added Successfuly', 'success');
        return Redirect('/show-product');
    }

    public function show_product()
    {
        $product_data = Product::get();
        return view('admin.show-product', compact('product_data'));
    }

    public function edit_product($id)
    {
        $product_data = Product::find($id);
        $category_data = Category::get();
        return view('admin.edit-product', compact('product_data', 'category_data'));
    }

    public function update_product(Request $request)
    {


        $product                 = product::find($request->id);
        $product->title          = $request->title;
        $product->description    = $request->description;
        $product->category       = $request->category;
        $product->quantity       = $request->quantity;
        $product->price          = $request->price;
        $product->discount_price = $request->discount_price;
        $image =  $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }
        $product->save();
        flash('Product Update Successfuly', 'success');
        return Redirect('/show-product');
    }

    public function delete_product($id)
    {
        $product_data = Product::find($id);
        $product_data->delete();
        flash('Product delete Successfuly', 'success');
        return Redirect('/show-product');
    }

    public function view_order()
    {
        $orders = Orders::get();
        return view('admin.order', compact('orders'));
    }

    public function delivered($id)
    {
        $order = Orders::find($id);
        $order->delivery_status = 'delivered';
        $order->save();
        flash('Order Delivered Successfuly', 'success');
        return Redirect('/view-order');
    }

    public function printpdf($id)
    {
        $order = Orders::find($id);
        $pdf = PDF::loadview('admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function send_email($id)
    {
        $orders = Orders::find($id);
        return view('admin.email_info', compact('orders'));
    }

    public function send_user_email(Request $request, $id)
    {
        $orders = Orders::find($id);
        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,
        ];

        Notification::send($orders, new SendEmailNotification($details));

        return back();
    }

    public function search_data(Request $request)
    {
        $searchText = $request->search;

        $orders = Orders::where('name','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();

        return view('admin.order', compact('orders'));

    }
}
