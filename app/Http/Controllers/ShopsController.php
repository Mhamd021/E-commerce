<?php

namespace App\Http\Controllers;
use App\Models\shops;
use App\Models\Product;
use App\Models\ProductRating;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\api\BaseController as BaseController;
use App\Http\Resources\Shop as ShopResource;
use App\Events\RealTimeMessage;
use Illuminate\Support\Facades\File;
class ShopsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function allShops()
     {
         $shops = shops::all();

         return view('shops.all',compact('shops'));
     }

    public function index()
    {
        $shops = shops::latest()->paginate(5);

        return view('shops.index',compact('shops'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shops.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $image = $request->image;
        $newImage = time().$image->getClientOriginalName();
        $image->move('uploads/shops',$newImage);


        $shops =  shops::create([
            'user_id' => Auth::id(),
            'name' => $request['name'],
            'image' => 'uploads/shops/'.$newImage,
            'location' =>$request['location'],
            'description' =>$request['description'],

        ]);
         return redirect()->route('shop.owner');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $shops = shops::find($id);



        return view('shops.show',compact('shops'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shops = shops::find($id);
        $thisUser = Auth::user();
        if($shops->user_id==$thisUser->id)
        {
            return view('shops.edit')->with('shops', $shops);
        }
        else
        {
             return redirect()->back();
        }

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
        $shops = shops::find($id);
        $request->validate([
            'name' => 'required',

        ]);
        if($request->has('image'))
         {
        $image = $request->image;
        $newImage = time().$image->getClientOriginalName();
        $image->move('uploads/shops',$newImage);
         $shops->image =  'uploads/shops/'.$newImage ;
         }


        $shops->name = $request->name;
        $shops->location = $request->location;
        $shops->description = $request->description;
        $shops->save();
        return redirect()->route('shop.show',$shops->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shops = shops::find($id);
        $products = Product::where('shops_id',$shops->id)->get();
        foreach($products as $product)
        {
            File::delete($product->image);
            $product->delete();
        }
        $shops->delete();
        return redirect()->route('shop.owner')
        ->with('status','shop deleted successfully');

    }
    public function apishops()
    {
        $shops = shops::all();
        return $this->sendResponse(ShopResource::collection($shops), 'shops retrieved successfully.');
    }
    public function ownerHome()
    {

        return view('owner_home');
    }
    public function sendMessage(Request $request)
    {
        RealTimeMessage::dispatch(
            $request->input('fromUserId'),
            $request->input('toUserId'),
            $request->input('content')
        );


        return Response::json();

    }
}
