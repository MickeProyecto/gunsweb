<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    public function indexr(){
        $role=role::all();
        return $role;
    }
    public function creater(Request $request)
    {
        $request->validate([
            'role'=>'required | unique:role',
        ]);

        $role = new role();
        $role->role=$request->role;
        $role->save();
        /*return response()->json([
            'message' => 'Successfully created user!'
        ]);*/
    }
    public function readr(Request $request)
    {

    }
    public function updater(Request $request)
    {
        $role=role::findOrFail($request->id);
        $role->role=$request->role;
        $role->save();
        return $role;
    }
    public function deleter(Request $request)
    {
        role::destroy($request->id);
    }
}
