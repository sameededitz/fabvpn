<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

abstract class Controller
{
    public function loginsubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'remember' => 'boolean',
        ]);
        
        now()->toDateTimeString();
    }
}
