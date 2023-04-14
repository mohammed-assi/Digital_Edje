<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\CreateProductRequest;
use App\Http\Requests\product\UpdateProductRequest;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductCntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return success_response(product::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
       $product = product::create([
            'user_id' => auth()->user()->id,
            'name'=>$request['name'],
            'description' => $request['description'],
            'image'=> $this->UploadImage($request['image'],'product'),
        ]);

        return success_response($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return success_response(product::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {   
        if (! Gate::allows('update-Product', $id)) {
            return "you can update your assest only";
          }
       
       $product = product::find($id);
       $product->update($request->except('image'));

       if($request->hasFile('image')){
         $product->image = $this->UploadImage($request->image,'product');
         $product->save();
        }

        return success_response($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (! Gate::allows('destroy-Product', $id)) {
            return "you can destroy your assest only";
          }

        $product = product::find($id);
        if(isset($product->image)){
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return success_response();
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
