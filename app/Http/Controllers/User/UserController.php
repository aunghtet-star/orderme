<?php

namespace App\Http\Controllers\User;

use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user home page
    public function home(){
        $product = Product::orderBy('id','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart','history'));
    }

    // filter product
    public function filter($id){
        $product = Product::where('category_id',$id)->orderBy('id','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart','history'));
    }

    // direct change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    // change user password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

       $user = User::select('password')->where('id',Auth::user()->id)->first();

       $dbHashValue = $user->password;

       if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('auth#loginPage');
        }
        return back()->with(['notMatch' => 'The Old Password not Match. Try again!']);
    }

    // direct user account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    // user account change
    public function accountChange($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image
        if($request->hasFile('image')){
            // old image name | check => delete | store
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid(). $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data ['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess' => 'Admin Account Updated...']);
    }

    // direct product detail
    public function productDetail($id){
        $product = Product::where('id',$id)->first();
        $productList = Product::get();
        return view('user.main.detail',compact('product','productList'));
    }

    // cart list page
    public function list(){
        $cartList = Cart::select('carts.*','products.name as p_name','products.price as p_price','products.image as p_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();

        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->p_price*$c->qty;
        }
        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    // order history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(6);
        return view('user.main.history',compact('order'));
    }



    // password validation check
     private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ],[])->validate();
    }

    // get user data
     private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    // account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file'
        ],[])->validate();
    }
}
