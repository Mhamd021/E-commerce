<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\shops;
use App\Models\User;
use App\Models\category;
use Auth;
use Illuminate\Support\Facades\Response ;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = category::where('trending','1')->take(15)->get();
        $products = Product::where('trending','1')->take(15)->get();
        return view('home',compact('products','category'));
    }
    public function showusers()
        {
            $users = User::where('id', '!=', Auth::user()->id)->get();
            return view('messages.index', compact('users'));
        }


}
