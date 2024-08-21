<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user list page
    public function userList(){
        $users = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'. request('key') .'%')
                  ->orWhere('email','like','%'. request('key') .'%')
                  ->orWhere('gender','like','%'. request('key') .'%')
                  ->orWhere('phone','like','%'. request('key') .'%')
                  ->orWhere('address','like','%'. request('key') .'%');
                })
                  ->where('role','user')->paginate(3);
        $users->appends(request()->all());
        return view('admin.user.list',compact('users'));
    }

    // ajax change role
    public function ajaxChangeRole(Request $request){
        User:: where('id',$request->userId)->update([
            'role' => $request->role,
        ]);
    }

    // user delete
    public function userDelete(Request $request){
        User:: where('id',$request->id)->delete();
        return back()->with(['deleteSuccess' => 'Account is deleted!']);
    }

    // user update page
    public function userUpdatePage($id){
        $userData = User::where('id',$id)->first();
        return view('admin.user.edit',compact('userData'));
    }

    // update user
    public function userUpdate(Request $request ){
        $this->userValidationCheck($request);
        $data = $this->requestUserInfo($request);

        if($request->hasFile('image')){
            $oldImageName = User::where('id',$request->id)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data ['image'] = $fileName;
        }

        User::where('id',$request->id)->update($data);
        return redirect()->route('admin#userList');

    }

    // request user info
    private function requestUserInfo($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
    }

    // user validation check
    private function userValidationCheck($request){
        $validationRules = [
            'name' => 'required|unique:users,name,'.$request->id,
            'email' => 'required',
            'phone' => 'required|min:10',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp,avif|file'
        ];

        Validator::make($request->all(),$validationRules)->validate();
    }
}
