<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function profile(){
        $user = Auth::user();
        $ads = User::find($user->id)->ads()->latest()->paginate(3);
        return view('user.profile', compact('user', 'ads'));
    }
}
