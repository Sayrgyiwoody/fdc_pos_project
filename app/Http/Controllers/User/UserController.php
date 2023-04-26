<?php

namespace App\Http\Controllers\User;
use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Direct to user home page
    public function home() {
        $products = Product::when(request('searchKey'),function($query) {
            $query->where('name','like','%'.request('searchKey').'%');
        })
        ->orderBy('created_at','desc')->paginate(9);
        $products->appends(request()->all());
        $categories = Category::orderBy('created_at','desc')->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $cartCount = count($cart);
        $order = Order::where('user_id',Auth::user()->id)->get();
        $orderCount = count($order);
        return view('user.main.home',compact('products' , 'categories','cartCount','orderCount'));
    }

    public function homeAsc() {
        $products = Product::when(request('searchKey'),function($query) {
            $query->where('name','like','%'.request('searchKey').'%');
        })
        ->orderBy('created_at','asc')->paginate(9);
        $products->appends(request()->all());
        $categories = Category::orderBy('created_at','desc')->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $cartCount = count($cart);
        $order = Order::where('user_id',Auth::user()->id)->get();
        $orderCount = count($order);
        return view('user.main.home',compact('products' , 'categories','cartCount','orderCount'));
    }

    //Filter with Category
    public function categoryFilter($categoryId) {
        $products = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->paginate(9);
        $products->appends(request()->all());
        $categories = Category::orderBy('created_at','desc')->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $cartCount = count($cart);
        $order = Order::where('user_id',Auth::user()->id)->get();
        $orderCount = count($order);
        return view('user.main.home',compact('products' , 'cartCount' , 'categories','orderCount'));
    }

    // Direct to user password change page
    public function passwordChangePage() {
        return view('user.account.passwordChangePage');
    }

    //User password Change
    public function passwordChange(Request $request) {
        $this->passwordValidationCheck($request);
        $dbHashPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword, $dbHashPassword)) {
            $newPassword = hash::make($request->newPassword);
            User::where('id',Auth::user()->id)->update([
                'password' => $newPassword
            ]);
            return redirect()->route('user#home')->with(['newPasswordAlert' => 'Password changed successfully']);
        }
        // dd('password not same');
        return back()->with(['changePasswordFail'=>'Old Password not correct.']);
    }

    //check password validation
    private function passwordValidationCheck($request) {
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword'
        ])->validate();
    }

    public function informationPage() {
        return view('user.account.informationPage');
    }

    //Direct to Update account page
    public function updateAccountPage() {
        return view('user.account.updateAccountPage');
    }

    //Update account information
    public function updateAccount($id,Request $request) {
        //check validation
        $this->accountValidationCheck($request);
        $data = $this->getAccountData($request);
        if($request->hasFile('image')) {
            $dbImage = User::select('image')->where('id',$id)->first();
            $dbImage =$dbImage->image;
            if($dbImage!=null) {
                Storage::delete('public/profileImages/'.$dbImage);
            }
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $data['image'] = $imageName;
            $request->file('image')->storeAs('public/profileImages/',$imageName);
        }
        User::where('id',$id)->update($data);
        return redirect()->route('user#informationPage')->with(['updateAccountAlert'=>'Account information Updated successfully.']);
    }

    //Account input validation check
    private function accountValidationCheck($request) {
        Validator::make($request->all(),[
            'name' => 'required|min:3|max:20',
            'email' => 'required|max:40',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg,JPEG|file',
            'phone' => 'required|min:6',
            'address' => 'required|max:50'
        ])->validate();
    }

    //get account data as object format
    private function getAccountData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => Carbon::now(),
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }

    //show product detail
    public function productDetail($productId) {
        $product = Product::where('id',$productId)->first();
        $view_count = $product->view_count+1;
        Product::where('id',$productId)->update([
            'view_count' => $view_count
        ]);
        $products = Product::get();
        return view('user.main.detail',compact('product','products'));
    }

}
