<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showuser(){
        $userData =User::get();
        
        return response()->json([
            'data' => $userData
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|min:6',
            'email' => 'required|email',
            'username' => 'required',
            'password' =>'required|min:8',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role
        ]);
        $data = User::latest()->first();

        return response()->json([
            'messege' => $data
        ]);
    }

    public function update(Request $request,$id){
        
        $this->validate($request,[
            'name' => 'required|min:6',
            'email' => 'required|email',
            'username' => 'required',
            'password' =>'required|min:8',
            'role' => 'required'
        ]);

        $userdata = User::find($id);

        $userdata->name = $request->name;
        $userdata->email = $request->email;
        $userdata->username = $request->username;
        $userdata->password = $request->password;
        $userdata->role = $request->role;

        $userdata->save();

        return response()->json([
            'userdata' => $userdata
        ]);
    }
    
    public function delete($id){
        $user = User::find($id);

if ($user) {
    // If the user exists, delete it
    $user->delete();
    return response()->json([
        "User Deleted"
    ]);
} else {
    return response()->json([
        "User Not found"
    ]);
}
    }

}
