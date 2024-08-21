<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // direct contact form page
    public function contactForm(){
        return view('user.main.contact');
    }

    // send contact
    public function contactSend(Request $request){
        $this->contactValidationCheck($request);
        $data = $this->getContactData($request);

        Contact::create($data);

        return redirect()->route('user#home')->with(['sendSuccess' => 'Message Sending is Success.....']);
    }

    //  admin message list
    public function messageList(){
        $message = Contact::paginate(5);
        return view('admin.message.list',compact('message'));
    }

    // delet message
    public function deleteMessage($id){
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Message Successfully Deleted...']);
    }

    // get contact data
    private function getContactData($request){
        return [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'subject' => $request->subject,
            'message' => $request->yourMessage
        ];
    }

    // contact validation check
    private function contactValidationCheck($request){
        $validationRules = [
            'subject' => 'required',
            'yourMessage' => 'required'
        ];

        Validator::make($request->all(),$validationRules)->validate();
    }
}
