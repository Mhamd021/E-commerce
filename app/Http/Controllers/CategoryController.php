<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\shops;
use App\Models\User;
use App\Models\Cart;
use App\Models\Delivery;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
        public function index()
        {
            $category = category::all();
            return view('category.index',compact('category'));
        }
        public function edit($id)
        {
            $category = category::find($id);
            return view('category.edit',compact('category'));
        }

        public function update(Request $request,$id)
        {
            $category = category::find($id);
            if($request->has('image'))
        {
       $image = $request->image;
       $newImage = time().$image->getClientOriginalName();
       $image->move('uploads/category',$newImage);
        $category->image =  'uploads/category/'.$newImage ;
        }
        $category->save();
        return redirect()->route('category.show')->with('status','category updated successfully');
        }
        public function allCategory()
        {
            $category = category::all();
            return view('category.all',compact('category'));
        }
        public function show($id)
        {
            $category = category::find($id);
            $products = Product::where('category',$category->name)->get();
            return view('category.show',compact('products','category'));
        }

}
