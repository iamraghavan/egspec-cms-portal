<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        // Apply middleware to ensure the user is authenticated
        $this->middleware('auth');
    }
    public function admin()
    {
        $user = Auth::user();
        return view('admin.dashboard', ['user' => $user]);
    }
}
