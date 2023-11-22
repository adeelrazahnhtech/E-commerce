<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = User::with('user_role')->where('role', '=', 2)->get();
        return view('seller.seller.list', compact('sellers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('edit', User::class);
       $seller = User::findOrFail($id);
       return view('seller.seller.edit',compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {    
        $this->authorize('update', User::class);

        $seller = User::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
           'email' => 'required|email|unique:users,email'
        ]);

        
        $validatedData = $validator->validated();

        if($validator->passes()){

            $seller->update($validatedData);
            flash()->addSuccess("User updated successfully");
            return redirect()->route('sellers.index');
        }

        return redirect()->route('sellers.edit')->withError($validator)->withInput();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete',User::class);
        
        $user = User::findOrFail($id);
        $user->delete();
        flash()->addSuccess('User deleted successfully');
        return redirect()->route('sellers.index');

    }
}
