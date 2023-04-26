<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Direct to product list page
    public function list() {
        $products = Product::select('products.*','categories.name as category_name')
        ->when(request('searchKey'),function($query){
            $query->where('products.name','like','%'.request('searchKey').'%');
        })
        ->join('categories','products.category_id','categories.id')
        ->orderBy('products.updated_at','desc')->paginate(4);
        $products->appends(request()->all());
        return view('admin.product.list',compact('products'));
    }

    //Direct to create product page
    public function createPage() {
        $categories = Category::select('id','name')->get();
        return view('admin.product.createPage',compact('categories'));
    }

    //create product
    public function create(Request $request) {
        $this->productValidationCheck($request);
        $product = $this->productGetData($request);
        if($request->hasFile('productImage')) {
            $productImageName = uniqid(). '_' . $request->file('productImage')->getClientOriginalName();
            $product['image'] = $productImageName;
            $request->file('productImage')->storeAs('public/productImages',$productImageName);
        }
        Product::create($product);
        return redirect()->route('product#list')->with(['createAlert' => 'Product Created successfully']);
    }

    //view product
    public function view($id) {
        $product = Product::select('products.*','categories.name as category_name')
        ->join('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.viewPage',compact('product'));
    }

    //Direct to edit product Page
    public function editPage($id){
        $categories = Category::get();
        $product = Product::where('id',$id)->first();
        $old_category_id = $product->category_id;
        return view('admin.product.editPage',compact('categories','product','old_category_id'));
    }

    //update product
    public function edit(Request $request,$id) {
        $this->productValidationCheck($request,$id);
        $data = $this->productGetData($request);
        //image check
        if($request->hasFile('productImage')) {
            $dbImage = Product::select('image')->where('id',$id)->first();
            $dbImage = $dbImage->image;
            if($dbImage!=null) {
                Storage::delete('public/productImages/'.$dbImage);
            }
            $imageName = uniqid() . '_' . $request->file('productImage')->getClientOriginalName();
            $data['image'] = $imageName;
            $request->file('productImage')->storeAs('public/productImages/',$imageName);
        }
        Product::where('id',$id)->update($data);
        return redirect()->route('product#list')->with(['updateAlert'=>'Product updated successfully.']);
    }

    //delete product
    public function delete($id) {
        $dbImage = Product::select('image')->where('id',$id)->first();
        $dbImage = $dbImage->image;
            if($dbImage!=null) {
                Storage::delete('public/productImages/'.$dbImage);
            }
        Product::where('id',$id)->delete();
        return back()->with(['deleteAlert'=>'Product deleted successfully.']);
    }


    //validate pizza product
    private function productValidationCheck($request,$id=0) {
        Validator::make($request->all(),[
            'productName' => 'required|unique:products,name,'. $id,
            'productDescription' => 'required',
            'productWaiting' => 'required',
            'productPrice' => 'required',
            'productImage' => 'required|mimes:png,jpg,jpeg,JPEG,webp|file',
            'categoryId' => 'required'
        ])->validate();
    }

    //get data from product input
    private function productGetData($request) {
        return [
            'name' => $request->productName,
            'description' => $request->productDescription,
            'waiting_time' => $request->productWaiting,
            'price' => $request->productPrice,
            'category_id' => $request->categoryId,
            'updated_at' => Carbon::now()
        ];
    }
}

