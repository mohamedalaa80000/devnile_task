<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Supervisor\CategoryUpdateRequest;
use App\Http\Requests\Supervisor\CategorySaveRequest;
use App\Models\Category;
use Storage;

class CategoriesController extends Controller
{
    /*
    |
    |   this method will show list of categories
    |
    */
    public function index(){
        $categories = Category::get();
        return view('dashboard.categories.index',compact('categories'));
    }
    /*
    |
    |   this method will show category by id
    |
    */
    public function view(Category $category){
        return view('dashboard.categories.view',compact('category'));

    }
    /*
    |
    |   this method will show new category form
    |
    */
    public function add(){
        return view('dashboard.categories.add');
    }
    /*
    |
    |   this method will update category by id
    |
    */
    public function save(CategorySaveRequest $request){
        $dataToSave = ['name','slug'];
        $request['slug'] = $request->name;
        if($request->hasFile('icon_file')){
            $file = $request->file('icon_file');
            $filename = 'categories/'.\Str::uuid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($filename, \File::get($file));
            $request['icon'] = $filename;
            $dataToSave[] = 'icon';
        }
        Category::create($request->only($dataToSave));
        return redirect()->back()->withSuccess('Category created Successfully ...');
    }
    /*
    |
    |   this method will update category by id
    |
    */
    public function update(CategoryUpdateRequest $request,Category $category){
        $dataToUpdate = ['name','slug'];
        $request['slug'] = $request->name;
        if($request->hasFile('icon_file')){
            $file = $request->file('icon_file');
            if($category->icon != 'placeholder.jpg'){
                Storage::disk('public')->delete($category->icon);
            }
            $filename = 'categories/'.\Str::uuid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($filename, \File::get($file));
            $request['icon'] = $filename;
            $dataToUpdate[] = 'icon';
        }
        $category->update($request->only($dataToUpdate));
        return redirect()->back()->withSuccess('Category updated Successfully ...');
    }
    /*
    |
    |   this method will soft delete array of categories 
    |
    */
    public function destroy(Request $request){
        $categories = Category::whereIn('id',explode(',',$request->input('ids')));
        foreach($categories->get() as $category){
            if($category->icon != 'placeholder.jpg'){
                Storage::disk('public')->delete($category->icon);
            }
        }
        $categories->delete();
        return redirect()->back()->withSuccess('categories deleted Successfully ...');
    }
}

