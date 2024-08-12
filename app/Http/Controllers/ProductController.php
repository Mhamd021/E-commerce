<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\shops;
use App\Models\User;
use App\Models\Cart;
use App\Models\order;
use App\Models\Delivery;
use App\Models\category;
use App\Models\ProductRating;
use App\Http\Controllers\Auth\api\BaseController as BaseController;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Category as CategoryResource;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ProductController extends BaseController
{


    public function SuperAdmin()
    {
        $products = Product::all();
        $shops = shops::all();
        $users = User::all();
        $delivers = Delivery::all();

        return view('admin_home',compact('products','shops','users','delivers'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(20);

        return view('product.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $shop = shops::find($id);
        $user = Auth::user();
        if($shop->user_id==$user->id)
        {
            $category = category::all();
            return view('product.create',compact('category'));
        }
        else
        {
             return redirect()->back();
        }

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
            'price' => 'required',
            'category' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);



        $image = $request->image;
        $newImage = time().$image->getClientOriginalName();
        $image->move('uploads/products',$newImage);




        $s = shops::find($request->store_id);
        $user = Auth::user();
        if($s->user_id==$user->id)
        {
            if($request->trending == true)
            {
                $trend = '1';
            }
            else
            {
                $trend = '0';
            }
            $product = Product::create
            ([
                'shops_id' => $request['store_id'],
                'name' => $request['name'],
                'price' => $request['price'],
                'category' => $request['category'],
                'detail' => $request['detail'],
                'quantity' => $request['qty'],
                'image' => 'uploads/products/'.$newImage,
                'trending' => $trend,


            ]);

            return redirect()->route('shop.show',$s->id)->with('status','product added successfully');
        }
        else
        {
             return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $ratings = ProductRating::where('product_id',$product->id)->get();
        if($ratings->count()>0)
        {
            $rating_sum = ProductRating::where('product_id',$product->id)->sum('stars_rated');
            $rating_value= $rating_sum/$ratings->count();
        }
        else
        {
            $rating_value =0;
        }
        // $order = order::where('status','finished')->get();
        // $carts = $order->transform(function ($cart,$key)
        // {
        //     return unserialize($cart->cart);
        // });
$shop = $product->shops;

        return view('product.show',compact('product','ratings','rating_value','shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $shop = shops::find($product->shops_id);
        $user = Auth::user();
        if($shop->user_id==$user->id)
        {
            $category = category::all();
            return view('product.edit',compact('product','category'));
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'detail' => 'required',
        ]);



        if($request->has('image'))
        {
       $image = $request->image;
       $newImage = time().$image->getClientOriginalName();
       $image->move('uploads/products',$newImage);
        $product->image =  'uploads/products/'.$newImage ;
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->detail = $request->detail;
        $product->quantity = $request->qty;
        $product->trending = $request->input('trending') == TRUE ?  '1' : '0';
        $product->save();

        return redirect()->route('shop.show',$product->shops_id)->with('status','product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        File::delete($product->image);
        $product->delete();

        return redirect()->route('shop.show',$product->shops_id)->with('status','product deleted successfully');
    }

    public function addToCart(Product $product)
    {
        if(session()->has('cart'))
        {
            $cart = new Cart(session()->get('cart'));
        }
        else
        {
            $cart = new Cart();
        }
        $cart->add($product);
        // dd($cart);
        session()->put('cart',$cart);
        return redirect()->back();
    }
    public function showCart()
    {
        if(session()->has('cart'))
        {
            $cart = new Cart(session()->get('cart'));
        }
        else
        {
            $cart = null;
        }
        return view('cart.show',compact('cart'));
    }

    public function checkout(Product $product)
    {
        //  auth()->user()->orders()->create
        // ([
        //     'cart' => serialize(session()->get('cart')),
        //     'location' => 0,
        //     'time' => 0,
        // ]);
        $shops = shops::find(1);
        $deliver = $shops->delivers;
        return view('orders.checkout',compact('deliver'));

    }
    public function removefromcart(Product $product)
    {
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);

        if ($cart->totalQty <= 0)
        {
            session()->forget('cart');
        }
        else
        {
             session()->put('cart',$cart);
        }
        return redirect()->route('cart.show');


    }

 public function product_list()
 {
    $products = Product::all();
    $data = [];
    foreach($products as $key => $value)
    {

        $data[$key] = $value['name'];

    }
    return $data;
 }
 public function searchproducts(Request $request)
 {
$search_product = $request->searchproduct;
if($search_product!="")
{
    $product = Product::where("name","LIKE","%$search_product%")->first();
    if($product)
    {
         return redirect()->route('product.show',$product->id);
    }else
    {
        return redirect()->back()->with('status','no matching products');
    }
} else
{
     return redirect()->back();
}
 }

    //api
    public function apiIndex()
    {
        $products = Product::where('trending','1')->get();
        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }
    public function Category()
    {
        $categories = category::where('trending','1')->get();
        return $this->sendResponse(CategoryResource::collection($categories), 'categories retrieved successfully.');
    }
    public function AllCategory()
    {
        $categories = category::all();
        return $this->sendResponse(CategoryResource::collection($categories), 'categories retrieved successfully.');
    }

    public function CategoryProducts($id)
    {

        $category = category::find($id);
        $products = Product::where('category',$category->name)->get();
          return $this->sendResponse(ProductResource::collection($products), 'products retrieved successfully.');


    }
    public function ShopProducts($id)
    {

        $shop = shops::find($id);
        $products = Product::where('shops_id',$shop->id)->get();
          return $this->sendResponse(ProductResource::collection($products), 'products retrieved successfully.');


    }

}
