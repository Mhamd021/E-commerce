<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Delivery;
use App\Models\shops;
use App\Models\Cart;
use App\Models\Order;
use App\Models\StoreOrders;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('delivery.create');
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
            'city'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'delivery_charg' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $image = $request->image;
        $newImage = time().$image->getClientOriginalName();
        $image->move('uploads/delivery',$newImage);

        $delivery =  Delivery::create([
            'user_id' => Auth::id(),
            'name' => $request['name'],
            'city'=>$request['city'],
            'image' => 'uploads/delivery/'.$newImage,
            'description' => $request['description'],
            'delivery_charg' => $request['delivery_charg'],
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
        ]);
         return redirect()->route('delivery.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        $delivery = Delivery::find($id);
        return view('delivery.show')->with('delivery', $delivery);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delivery = Delivery::find($id);
        return view('delivery.edit')->with('delivery', $delivery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $id)
    {
        $delivery = Delivery::find($id);
        $request->validate([
            'name' => 'required',
            'city'=>'required',
            'description' => 'required',
            'delivery_charg' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        if($request->has('image'))
        {
       $image = $request->image;
       $newImage = time().$image->getClientOriginalName();
       $image->move('uploads/delivery',$newImage);
        $delivery->image =  'uploads/delivery/'.$newImage ;
        }
        $delivery->name = $request->name;
        $delivery->city = $request->city;
        $delivery->description = $request->description;
        $delivery->delivery_charg = $request->delivery_charg;
        $delivery->start_time = $request->start_time;
        $delivery->end_time = $request->end_time;
        $delivery->save();
         return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        //
    }
    public function deliverHome()
    {

        $shops = shops::latest()->paginate(5);
        $user = Auth::user();
        $order = Order::where('status','finished')->get();
        $orders = Order::where('status','pending')->get();
        $ready = StoreOrders::where('status','ready')->get();

        return view('delivery.delivery_home',compact('order','orders','ready'));


    }

    // public function attach($id)
    // {

    //     $shops = shops::find($id);
    //     $delivery = Auth::user()->delivery;
    //     $delivery->shops->attach($shops);
    //     return view('delivery.delivery_home');
    // }
    public function map()
    {
        return view('orders.map');
    }
}
