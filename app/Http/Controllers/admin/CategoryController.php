<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderByDesc('id')->get();
        $data['categories'] = $categories;
      return view('admin.category.list',$data);
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
      $validator = Validator::make($request->all(),[
       'name' => 'required|min:3',
       'image' => 'required|mimes:jpeg,jpg,png,gif|max:2048'
      ]);


      if($validator->passes()){
        $category = new Category();
           $category->name = $request->name;
           $category->status = $request->status;

           if(!empty($request->hasFile('image'))){
            $image = $request->file('image');
            $imageName = time().".".$image->getClientOriginalExtension();
            $image->move(public_path("uploads/category/"),$imageName);

            $category->image = $imageName;

           }
           $category->save();
           return redirect()->route('categories.index')->with('success','Category added successfully');

      }else{
        return redirect()->route('categories.create')
                             ->withErrors($validator)
                             ->withInput();
      }
    }

    public function edit($categoryId){
        $category = Category::find($categoryId);
      if(empty($category)){
          return redirect()->route('categories.index');
      }
      return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request,$categoryId){
        $category = Category::find($categoryId);
        if(empty($category)){
            return redirect()->route('categories.index');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048'
           ]);
        
        if($validator->passes()){
            $category->name = $request->name;
            $category->status = $request->status;
 
            if(!empty($request->hasFile('image'))){
             $image = $request->file('image');
             $imageName = time().".".$image->getClientOriginalExtension();
             $image->move(public_path("uploads/category/"),$imageName);
 
             $category->image = $imageName;
 
            }else{
             $category->image = $request->existing_image;

            }
            $category->save();
            return redirect()->route('categories.index')->with('success','Category updated successfully');
 
        }

    }


    public function destroy($categoryId){
        $category = Category::find($categoryId);
        if(empty($category)){
            return redirect()->route('categories.index');
        }
        File::delete("uploads/category/".$category->image);
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category deleted successfully');

    }
}
