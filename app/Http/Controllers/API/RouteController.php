<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // get all prouuct list
    public function productList(){
        $product = Product::get();
        $user = User::get();

        $data = [
            'product' => $product,
            'user' => $user
        ];
        return response()->json($data, 200);
    }

    // get all category list
    public function categoryList(){
        $category = Category::get();
        return response()->json($category, 200);
    }

    // create category
    public function categoryCreate(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response, 200);

    }

    // create contact
    public function contactCreate(Request $request){
        $data = $this->getContactData($request);

        Contact::create($data);

        $response = Contact::get();
        return response()->json($response, 200);

    }

    // delete category
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status'=>true,'message'=>'delete success','deleteData'=>$data], 200);
        }else{
            return response()->json(['status'=>false,'message'=>'There is no category for that Id'], 200);
        }
    }

    // category detail
    public function categoryDetail($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            return response()->json(['status'=>true,'category'=>$data], 200);
        }else{
            return response()->json(['status'=>false,'message'=>'There is no category for that Id'], 200);
        }
    }

    // category update
    public function categoryUpdate(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
             Category::where('id',$request->category_id)->update([
                'name' => $request->name
            ]);
            $data = Category::where('id',$request->category_id)->get();
            return response()->json(['status'=>true,'updateData'=>$data], 200);
        }else{
            return response()->json(['status'=>false,'message'=>'There is no category for that Id'], 200);
        }
    }

    // get contact data
    private function getContactData($request){
        return  [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
