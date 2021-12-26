<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Supervisor\ProductUpdateRequest;
use App\Http\Requests\Supervisor\ProductImagesUploadRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Storage;

class ProductsController extends Controller
{
    /*
    |
    |   this method will show list of products
    |
    */
    public function index(){
        $products = Product::where('name','<>','NULL')->where('slug','<>','NULL')->get();
        return view('dashboard.products.index',compact('products'));
    }
    /*
    |
    |   this method will show product by id
    |
    */
    public function view(Product $product){
        $categories = Category::get();
        return view('dashboard.products.view',compact('product','categories'));

    }
    /*
    |
    |   this method will show new product form
    |
    */
    public function add(){
        $categories = Category::get();
        $product = Product::create();
        return view('dashboard.products.view',compact('product','categories'));
    }
    /*
    |
    |   this method will update product by id
    |
    */
    public function update(ProductUpdateRequest $request,Product $product){
        $dataToUpdate = ['name','slug','category_id','description'];
        $request['slug'] = $request->name;
        if($request->hasFile('image_file')){
            $file = $request->file('image_file');
            $filename = 'products/'.\Str::uuid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($filename, \File::get($file));
            $request['image'] = $filename;
            $dataToUpdate[] = 'image';
        }
        $product->update($request->only($dataToUpdate));
        return redirect()->back()->withSuccess('Product updated Successfully ...');
    }
    /*
    |
    |   this method will soft delete array of products 
    |
    */
    public function imageUpload(ProductImagesUploadRequest $request,Product $product){
        if($request->hasFile('media')){
            $dataToSave = ['path','file_name','product_id'];
            $file = $request->file('media');
            $filename = 'product_images/'.\Str::uuid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($filename, \File::get($file));
            $request['path'] = $filename;
            $request['file_name'] = $file->getClientOriginalName();
            $request['product_id'] = $product->id;
            ProductImage::create($request->only($dataToSave));
        }
    }
    /*
    |
    |   this method will delete image from product images
    |
    */
    public function removeImageUpload(Request $request,Product $product){
        $product_image = ProductImage::where('id',$request->file_id)->where('product_id',$product->id)->firstOrFail();
        Storage::disk('public')->delete($product_image->path);
        $product_image->delete();
    }
    /*
    |
    |   this method will soft delete array of categories 
    |
    */
    public function destroy(Request $request){
        $products = Product::whereIn('id',explode(',',$request->input('ids')));
        foreach($products->get() as $product){
            if($product->image != 'placeholder.jpg'){
                Storage::disk('public')->delete($product->image);
            }
            Storage::disk('public')->delete($product->images()->pluck('path')->toArray());
            $product->images()->delete();
        }
        $products->delete();
        return redirect()->back()->withSuccess('products deleted Successfully ...');
    }
}


