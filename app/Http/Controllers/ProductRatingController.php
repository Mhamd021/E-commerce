<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductRating;
use Auth;

class ProductRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRating(Request $request)
    {
        $stars_rated = $request->input('product_rating');
        $product_id = $request->input('product_id');
        $existing_rating = ProductRating::where('user_id',Auth::id())->where('product_id',$product_id)->first();
        if($existing_rating)
        {
            $existing_rating->stars_rated = $stars_rated;
            $existing_rating->update();
        }
        else
        {
            ProductRating::create([
                'user_id' => Auth::id(),
                'product_id'=> $product_id,
                'stars_rated'=>$stars_rated,
            ]);
        }
 return redirect()->back()->with('status',"Done");

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
