<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jasas = Jasa::paginate(20);
        return view('dashboard', compact('jasas'));
    }
}
