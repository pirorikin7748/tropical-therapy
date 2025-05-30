<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductViewController extends Controller
{
    public function index()
    {
        return view('products.index'); // VueがマウントされるBlade
    }
}
