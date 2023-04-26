<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //Direct to User contact page
    public function userPage() {
        return view('user.main.contact.form');
    }

    //Direct to Admin contact page
    public function adminPage() {
        $message = Contact::when(request('searchKey'),function($query){
            $query->where('name','like','%'.request('searchKey').'%');
        })
        ->orderBy('created_at','desc')->paginate(5);
        // $total_message = count(Contact::get());
        return view('admin.contact.list',compact('message'));
    }

    //send contact message
    public function contact(Request $request) {
        $data = $this->getContactData($request);
        Contact::create($data);
        return redirect()->route('user#home')->with(['contactMessage' =>'message sent successfully.']);
    }

    //get contact data in array format
    public function getContactData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ];
    }

    //Delete Contact message admin
    public function delete(Request $request) {
        Contact::where('id',$request->message_id)->delete();
        return response()->json(200);
    }

    //Delete all message admin
    public function deleteAll() {
        Contact::truncate();
        return response()->json(200);
    }

    //view all information
    public function view($id) {
        $message = Contact::where('id',$id)->first();
        return view('admin.contact.viewPage',compact('message'));
    }


}

