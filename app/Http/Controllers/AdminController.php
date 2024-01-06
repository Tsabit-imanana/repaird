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

    
}
