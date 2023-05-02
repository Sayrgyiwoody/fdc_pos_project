<?php

namespace App\Http\Controllers\API;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function productList() {
        $products = Product::orderBy('created_at','desc')->get();
        return response()->json($products,200);
    }

    public function productDetail($id) {
        $product = Product::where('id',$id)->first();
        if(isset($product)) {
        return response()->json($product,200);
        }
        return response()->json(['status'=>'false','message'=>'Product not found.'],500);
    }

    public function categoryDetail($id) {
        $category = Category::where('id',$id)->first();
        if(isset($category)) {
        return response()->json($category,200);
        }
        return response()->json(['status'=>'false','message'=>'Category not found.'],500);
    }

    public function categoryList() {
        $categories = Category::orderBy('created_at','desc')->get();
        return response()->json($categories,200);
    }

    public function userList() {
        $users = User::orderBy('created_at','desc')->get();
        return response()->json($users,200);
    }

    public function orderList() {
        $orders = Order::orderBy('created_at','desc')->get();
        return response()->json($orders,200);
    }

    public function contactList() {
        $contacts = Contact::orderBy('created_at','desc')->get();
        return response()->json($contacts,200);
    }

    public function categoryCreate(Request $request) {
        $data = [
            'name' => $request->name
        ];
        $response = Category::create($data);
        return response()->json($response, 200);
    }

    //create product
    public function productCreate(Request $request) {
        $product = $this->productGetData($request);
        if($request->hasFile('productImage')) {
            $productImageName = uniqid(). '_' . $request->file('productImage')->getClientOriginalName();
            $product['image'] = $productImageName;
            $request->file('productImage')->storeAs('public/productImages',$productImageName);
        }
        $response = Product::create($product);
        return response()->json($response,200);
    }

    //get data from product input
    private function productGetData($request) {
        return [
            'name' => $request->name,
            'description' => $request->description,
            'waiting_time' => $request->waiting_time,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ];
    }

    public function categoryDelete($id) {
        $data = Category::where('id',$id)->first();
        if(isset($data)) {
        Category::where('id',$id)->delete();
        $data = [
            'status' => true,
            'message' => "Category deleted successfully",
            'category' => $data
        ];
        return response()->json($data,200);
        };
        return response()->json(['status'=>false,'message'=>"Category delete fail"],500,);
    }

    public function productDelete(Request $request) {
        $data = Product::where('id',$request->id)->first();
        if(isset($data)) {
        $dbImage = Product::select('image')->where('id',$request->id)->first();
        $dbImage = $dbImage->image;
        if($dbImage!=null) {
            Storage::delete('public/productImages/'.$dbImage);
        }
        Product::where('id',$request->id)->delete();
        $data = [
            'status' => true,
            'message' => "Product deleted successfully"
        ];
        return response()->json($data,200);
        };
        return response()->json(['status'=>false,'message'=>"Product delete fail"],500);
    }

    public function categoryUpdate(Request $request) {
        $category = Category::where('id',$request->id)->first();
        if(isset($category)) {
            $data = [
                'name' => $request->name
            ];
            Category::where('id',$request->id)->update($data);
            $category = Category::where('id',$request->id)->first();
            return response()->json(['status' => true,'message' => 'update category success.','category'=>$category],200);
        }
        return response()->json(['status'=>false,'message'=>"Category update fail"],500);
    }
}
