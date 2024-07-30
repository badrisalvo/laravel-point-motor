<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pelanggan = Pelanggan::with('user')->where('id_user', $user->id)->get();
        return view('admin.index', compact('pelanggan'));
    }
}
