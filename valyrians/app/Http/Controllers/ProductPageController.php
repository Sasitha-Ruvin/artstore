<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductPageController extends Controller
{
    //
     public function index(){
        $products = Product::all();
        return view('arts', compact('products'));
    }
    
}
