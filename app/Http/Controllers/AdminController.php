<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }
    public function index(){
        $users = User::all();
        return view('admin.panel', compact('users'));
    }
    public function setRevisor(User $user){
        $user->is_revisor = 1;
        $user->save();
        return redirect()->back();
    }
    public function removeRevisor(User $user){
        $user->is_revisor = 0;
        $user->save();
        return redirect()->back();
    }



}
