<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(){
        return view('pages.index');
    }

    public function dashboard(){
        // $products = Product::all();
        // return view('pages.dashboard')->with('products',$products);
        return view('pages.dashboard');
    }

    public function report(){
        return view('pages.report');        
    }

    // public function items(){
    //     return view('pages.items');
    // }

    public function employees(){
        return view('pages.employees');
    }
    public function showAboutPage(){
        return view('pages.about');
    }

}
