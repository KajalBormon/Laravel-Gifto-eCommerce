<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function view_category(){
        $category = Category::all();
        return view('admin.category',compact('category'));
    }

    public function add_category(Request $request){
        $category = Category::create([
            'category_name' => $request->category,
        ]);

        return redirect()->back()->with('status', $request->category.' Category Add Successfully');
    }

    public function delete_category($id){
        $category_delete = Category::find($id);

        $category_delete->delete();

        return redirect()->back()->with('status','Category Delete Successfully');
    }

    public function edit_category($id){
        $edit = Category::find($id);
        return view('admin.edit_category',compact('edit'));
    }

    public function update_category(Request $request,$id){
        $update = Category::find($id);

        $update->update([
            'category_name' => $request->update_category_name
        ]); 

        return redirect()->route('view_category')->with('status','Updated Successfully');
    }

    public function add_product(){
        $category = Category::all();
        return view('admin.add_product',compact('category'));
    }

    public function upload_product(Request $request){
        $request->validate([
           'image' => 'required|mimes:jpg,jpeg,png' 
        ]);

        $path = $request->file('image')->store('products','public');
        

        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'quantity' => $request->qty,
            'image' => $path
        ]);

        return redirect()->back()->with('status','Product Add Successfully');
    }

    public function view_product(){
        $products = Product::paginate(3);
        return view('admin.view_product',compact('products'));
    }

    public function delete_product($id){
        $product_delete = Product::find($id);

        $product_delete->delete();

        $image_path = public_path('storage/').$product_delete->image;

        if(file_exists($image_path)){
            @unlink($image_path);
        }

        return redirect()->route('view_product')->with('status','Product Deleted Successfully');
    }

    public function edit_product($id){
        $edit_product = Product::find($id);
        $category = Category::all();
        return view('admin.edit_product',compact('edit_product','category'));
    }

    public function update_product(Request $request,$id){
        $product = Product::find($id);

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'quantity' => $request->qty
        ]);

        if($request->hasFile('image')){
            $image_path = public_path('/storage/'.$product->image);
            if(file_exists($image_path)){
                @unlink($image_path);
            }
        }
        $path = $request->file('image')->store('products','public');
        $product->image = $path;
        $product->save();

        return redirect()->route('view_product')->with('status','Update Product Successfully');
    }

    public function search(Request $request){
        $search = $request->search;
        $products = Product::where('title','LIKE','%'.$search.'%')
                            ->orWhere('category','LIKE','%'.$search.'%')
                            ->paginate(3);
                            
        return view('admin.view_product',compact('products'));
    }

    public function view_orders(){
        $orders_info = Order::all();
        return view('admin.orders',compact('orders_info'));
    }

    public function on_the_way($id){
        $data = Order::find($id);
        $data->update([
            'status' => 'On the Way'
        ]);

        return redirect('/view_orders');
    }

    public function delivered($id){
        $data = Order::find($id);
        $data->update([
            'status' => 'Delivered'
        ]);

        return redirect('/view_orders');
    }

    public function print_pdf($id){
        $data = Order::find($id);
        $pdf = pdf::loadView('admin.invoice',compact('data'));
        return $pdf->download('invoice.pdf');
    }

}
