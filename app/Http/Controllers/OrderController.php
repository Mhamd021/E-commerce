<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\shops;
use App\Models\Cart;
use App\Models\User;
use App\Models\Delivery;
use App\Models\StoreOrders;
use Illuminate\Http\Request;
use App\Notifications\OrderIsReady;
use App\Notifications\ThereIsAnOrder;
use App\Http\Controllers\Auth\api\BaseController as BaseController;
use App\Http\Resources\Order as OrderResource;
use Auth;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(20);
        return view('users.index',compact('orders'));
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
        $request->validate([

            'deliver_id' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'time_to_deliver' => 'required',
            'phone' => 'required',
        ]);
        $orders =  Order::create([
            'user_id' => Auth::id(),
            'deliver_id' => $request['deliver_id'],
            'cart' => serialize(session()->get('cart')),
            'lat' =>$request['lat'],
            'lng' =>$request['lng'],
            'time_to_deliver' =>$request['time_to_deliver'],
            'phone' =>$request['phone'],
        ]);
        $list = [];
        $cart = unserialize($orders->cart);
        foreach ($cart->items as $key => $value)
        {

            $list[$key]['shops_id'] = $value['store_id'];
            $list[$key]['order_id'] = $orders->id;
            $list[$key]['user_id'] = $orders->user_id;
            $list[$key]['deliver_id'] = $orders->deliver_id;
            $list[$key]['product_id'] = $value['id'];
            $list[$key]['user_name'] = Auth::user()->name;
            $list[$key]['store_name'] = $value['store_name'];
            $list[$key]['phone'] = $orders->phone;
            $list[$key]['name'] = $value['name'];
            $list[$key]['image'] = $value['image'];
            $list[$key]['price'] = $value['price'];
            $list[$key]['status'] = 'pending';
            $list[$key]['quantity'] = $value['qty'];
            $list[$key]['time_to_deliver'] = $orders->time_to_deliver;
            $list[$key]['created_at'] = $orders->created_at;
            $list[$key]['updated_at'] = $orders->updated_at;
            $shop = shops::find($value['store_id']);
            $user_id = $shop->user_id;
            User::find($user_id)->notify(new ThereIsAnOrder(Auth::user()->name,$value['store_id']));
        }
        StoreOrders::insert($list);


        // $sorder = StoreOrders::create([
        //     'user_id' => Auth::id(),
        //     'deliver_id' => $request['deliver_id'],
        //     'product' =>
        // ]);
        session()->forget('cart');

        return redirect()->route('home')->with('status','order is placed');


    }
    public function markAsRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $order = Order::find($id);
        $cart = unserialize($order->cart);
        $user = $order->user;

        return view('orders.show',compact('order','cart','user'));
    }
    public function UserDelivered($id)
    {

        $order = Order::find($id);
        $cart = unserialize($order->cart);

        return view('orders.delivered',compact('order','cart'));
    }
    public function User()
    {

        $orders = Auth::user()->orders->where('status','pending');
        if($orders->count()>0)
        {
            return view('orders.User',compact('orders'));
        }
        else
        {
             return redirect()->back()->with('order','you dont have any orders');
        }
    }


    public function shop($id)
    {

        $shop = shops::find($id);
       $storeorders= $shop->StoreOrders->where('status','pending');
        // $order = order::where('status','pending')->get();
        // $carts = $order->transform(function ($cart,$key)
        // {
        //     return unserialize($cart->cart);
        // });



                return view('orders.Store',compact('storeorders'));
    }


    public function done($id)
    {

        $p = StoreOrders::find($id);

        return view('orders.ready',compact('p'));
    }




    public function ready($id)
    {

        $p = StoreOrders::find($id);
        $shop = shops::find($p->shops_id);
        $d = Delivery::find($p->deliver_id);
        $user_id = $d->user_id;
        User::find($user_id)->notify(new OrderIsReady($p->name,$p->store_name));
        $p->status = "ready";
        $p->save();
        return redirect()->route('order.shop',$shop->id)->with('status','Deliver Notified');
    }



public function deliverd($id)
{
    $order = Order::find($id);
    $order->status = "finished";
    $order->save();
     return redirect()->route('order.User')->with('status','Thanks and your welcome!');
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
    public function apiOrders(Request $request)
    {
        $user = $request->user();
        $orders = $user->orders->where('status','finished');
        return $this->sendResponse(OrderResource::collection($orders), 'orders retrieved successfully.');
    }
    public function ActiveOrders(Request $request)
    {
        $user = $request->user();
        $orders = $user->orders->where('status','pending');
        return $this->sendResponse(OrderResource::collection($orders), 'orders retrieved successfully.');
    }

}
