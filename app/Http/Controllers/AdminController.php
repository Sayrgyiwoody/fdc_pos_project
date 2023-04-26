<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //Direct change password page
    public function changePasswordPage() {
        return view('admin.account.changePasswordPage');
    }

    //Change new password
    public function changePassword(Request $request) {
        $this->passwordValidationCheck($request);
        $dbHashPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword, $dbHashPassword)) {
            $newPassword = hash::make($request->newPassword);
            User::where('id',Auth::user()->id)->update([
                'password' => $newPassword
            ]);
            return redirect()->route('category#list')->with(['newPasswordAlert' => 'Password changed successfully']);
        }
        // dd('password not same');
        return back()->with(['changePasswordFail'=>'Old Password not correct.']);
    }



    //Direct to admin account information page
    public function informationPage() {
        return view('admin.account.informationPage');
    }

    //Direct to Update account page
    public function updateAccountPage() {
        return view('admin.account.updateAccountPage');
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
        return redirect()->route('admin#informationPage')->with(['updateAccountAlert'=>'Account information Updated successfully.']);
    }

    // Direct to admin accounts list
    public function adminList() {
        $accounts = User::when(request('searchKey'),function($query){
            $query->orWhere('name','like','%'.request('searchKey').'%')
                  ->orWhere('email','like','%'.request('searchKey').'%')
                  ->orWhere('phone','like','%'.request('searchKey').'%')
                  ->orWhere('address','like','%'.request('searchKey').'%')
                  ->orWhere('gender',request('searchKey'));

        })
        ->where('role','admin')
        ->paginate(4);
        return view('admin.account.adminList',compact('accounts'));

    }

    // Direct to user accounts list
    public function userList() {
        $accounts = User::when(request('searchKey'),function($query){
            $query->orWhere('name','like','%'.request('searchKey').'%')
                  ->orWhere('email','like','%'.request('searchKey').'%')
                  ->orWhere('phone','like','%'.request('searchKey').'%')
                  ->orWhere('address','like','%'.request('searchKey').'%')
                  ->orWhere('gender',request('searchKey'));

        })
        ->where('role','user')
        ->paginate(4);
        return view('admin.account.userList',compact('accounts'));

    }

    //delete account
    public function delete(Request $request) {
        User::where('id',$request->account_id)->delete();
        Order::where('user_id',$request->account_id)->delete();
        OrderList::where('user_id',$request->account_id)->delete();
        return response()->json(200);
    }

    //change admin to user role
    public function changeUserRole($id) {
        User::where('id',$id)->update([
            'role' => 'user'
        ]);
        return back()->with(['adminRoleChangeAlert' => 'Admin to User role changed successfully.']);
    }

    //change admin to user role
    public function changeAdminRole($id) {
        User::where('id',$id)->update([
            'role' => 'admin'
        ]);
        return back()->with(['adminRoleChangeAlert' => 'User to Admin role changed successfully.']);
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

    //check password validation
    private function passwordValidationCheck($request) {
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword'
        ])->validate();
    }
}
