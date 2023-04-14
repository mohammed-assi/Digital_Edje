<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Product\ProductRequest;
use App\Http\Requests\admin\Product\UpdateProductRequest;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminProductCntroller extends Controller
{
    
    public function index()
    {
        $product = product::simplePaginate(5);
        return view('product.index')->with(['products'=> $product]);
    }

    public function user_Product(string $id)
    {
        $product = product::where('user_id',$id)->simplePaginate(5);
        return view('product.userProduct')->with(['products'=> $product, 'user'=>User::find($id)]);
    }

    public function store(ProductRequest $request)
    {
       $product = product::create([
            'user_id' => auth()->user()->id,
            'name'=>$request['name'],
            'description' => $request['description'],
            'image'=> $this->UploadImage($request['image'],'product'),
        ]);
        return view('product.show')->with(['product'=>$product,'user'=> $product]);
    }

    public function create(Request $request){ 
        $user = User::all();
        return view('product.create')->with(['users'=>$user]);
    }
    
    public function show(string $id)
    {
        $product = product::find($id);
        return view('product.show')->with(['product'=> $product]);
    }

    public function edit(Request $request, string $id)
    {
        $user = User::all();
        $product = product::find($id);
        return view('product.edit')->with(['product'=> $product, 'users'=>$user]);
    }

    public function update(UpdateProductRequest $request , string $id){  

       $product = product::find($id);
       $product->update($request->except('image'));
       if($request->hasFile('image')){
         $product->image = $this->UploadImage($request->image,'product');
         $product->save();
        }
        return view('product.show')->with(['product'=> $product]);
    }
    
    public function destroy(string $id)
    {
        $product= product::find($id);
        if(isset($product->image)){
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        $products = product::all();
        return view('product.index')->with(['products'=> $products]);
    }

    public function UploadImage($image, $path)
    {
        //get file name with extentionupdateImage
        $filenameWithExt = $image->getClientOriginalName();
        //get just file name
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //GET EXTENTION
        $extention = $image->getClientOriginalExtension();
        //file name to store
        $fileNameToStore = $path.'/'.$filename.'_'.time().'.'.$extention;
        //upload image
        $path = $image->storeAs('public/', $fileNameToStore);

        return $fileNameToStore;
    }
}
