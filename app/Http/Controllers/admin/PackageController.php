<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function index(){
        $packages = Package::orderBy('id', 'DESC')->get();
        return view('admin.package.list',compact('packages'));
    }
    public function create(){
        return view('admin.package.create');
    }

    public function store(Request $request){
        $validator =  Validator::make($request->all(),[
            'title' => 'required|min:3',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'duration_unit' => 'required|in:months,years,weeks',
        ]);
        $validatedData = $validator->validated();
        if($validator->passes()){
            $package = Package::create($validatedData);
            return redirect()->route('packages.index')->with('success','package added successfully');
        }else{
            return redirect()->route('package.index')->with('error','package not added successfully');

        }
    }

    public function edit($packageId){
        
     $package = Package::find($packageId);
     if(!$package){
        return redirect()->route('packages.index')->with('error','Record is empty');
     }
     return view('admin.package.edit',compact('package'));
    }

    public function update(Request $request,$packageId){
        $package = Package::find($packageId);
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:3',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'duration_unit' => 'required|in:months,years,weeks',
        ]);

        $validatedData = $validator->validated();
        // dd($validatedData);
        if($validator->passes()){
            $package->update($validatedData);
            return redirect()->route('packages.index')->with('success','Package updated successfully');
        }else{
            return redirect()->route('packages.index')->with('error','Package updated successfully');

        }
    }

    public function destroy($packageId){
        $package = Package::find($packageId);
     if(!$package){
        return redirect()->route('packages.index')->with('error','Record is empty');
     }
     $package->delete();
     return redirect()->route('packages.index')->with('error','Package deleted successfully');
   
    }
}
