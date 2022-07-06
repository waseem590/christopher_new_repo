<?php

namespace App\Http\Controllers\Funds;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundsController extends Controller
{
    
    public function get_funds()
    {
        $funds = Auth::user()->funds;
        return $funds;
    }

    public function users()
    {
        return User::get(['id','username']);
    }
    
    public function add_funds(Request $request)
    {
        $user = User::find($request->user_id);
        if($user)
        {
            $user->update([
                'funds' => $user->funds + $request->price
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Funds Added Successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User Not Found'
        ]);
    }
}
