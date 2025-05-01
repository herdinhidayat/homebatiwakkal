<?php

namespace App\Http\Controllers;

use App\Jasa;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index($id)
    {
        $jasa = Jasa::where('id', $id)->first();

        return view('pesan.index', compact('jasa'));
    }
}
