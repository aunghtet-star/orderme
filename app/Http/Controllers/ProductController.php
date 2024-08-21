<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // direct product list page
    public function list(){
        $products = Product::select('products.*','categories.name as categories_name')
                  ->when(request('key'),function($query){
                    $query->where('products.name','like','%'.request('key').'%');
                  })
                  ->leftJoin('categories','products.category_id','categories.id')
                  ->orderBy('products.created_at','desc')
                  ->paginate(3);
        $products->appends(request()->all());
        return view('admin.products.pizzaList',compact('products'));
    }

    // direct product create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.products.create',compact('categories'));
    }

    // delete product
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Product successfully deleted...']);
    }

    // edit product
    public function edit($id){
        $products = Product::select('products.*','categories.name as categories_name')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->where('products.id',$id)->first();
        return view('admin.products.edit',compact('products'));
    }

    // update product page
    public function updatePage($id){
        $products = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.products.update',compact('products','category'));
    }

    // create product
    public function create(Request $request){
        $this->productValidationCheck($request,"create");
        $data = $this->requestProductInfo($request);

        $fileName = uniqid().$request->file('productImage')->getClientOriginaLName();
        $request->file('productImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list');
    }

    //update product
    public function update(Request $request){
        $this->productValidationCheck($request,"update");
        $data = $this->requestProductInfo($request);

        if($request->hasFile('productImage')){
            $oldImageName = Product::where('id',$request->productId)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public',$fileName);
            $data ['image'] = $fileName;
        }
        Product::where('id',$request->productId)->update($data);
        return redirect()->route('product#list');
    }

    // request product info
    private function requestProductInfo($request){
        return [
            'category_id' => $request->productCategory,
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
            'waiting_time' => $request->productWaitingTime,
        ];
    }

    // product validation check
    private function productValidationCheck($request,$action){
        $validationRules = [
            'productName' => 'required|min:3|unique:products,name,'.$request->productId,
            'productCategory' => 'required',
            'productDescription' => 'required|min:10',
            'productPrice' => 'required',
            'productWaitingTime' => 'required'
        ];

        $validationRules['productImage'] = $action == "create" ? 'required|mimes:png,jpg,jpeg,webp,avif|file' : "mimes:png,jpg,jpeg,webp,avif|file";

        Validator::make($request->all(),$validationRules)->validate();
    }
}
