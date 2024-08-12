<?php

namespace App\Models;
use Auth;
use App\Models\shops;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart
{
        public $items = [];
        public $totalQty ;
        public $totalPrice;

        public function __Construct($cart = null)
        {
                if($cart)
                {
                        $this->items = $cart->items;
                        $this->totalQty = $cart->totalQty;
                        $this->totalPrice = $cart->totalPrice;
                }
                else
                {
                    $this->items = [];
                        $this->totalQty = 0;
                        $this->totalPrice = 0;
                }
        }

        public function add($product)
        {
            $shop = shops::find($product->shops_id);
            $item =
            [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 0,
                'image' => $product->image,
                'store_id' => $product->shops_id,
                'store_name' => $shop->name,
                'user_name' => Auth::user()->name,


            ];
            if(!array_key_exists($product->id,$this->items))
            {
                $this->items[$product->id] = $item;
                $this->totalQty += 1 ;
                $this->totalPrice += $product->price;
            }
            else
            {
                $this->totalQty += 1 ;
                $this->totalPrice += $product->price;
            }
                $this->items[$product->id]['qty']  += 1 ;
        }
        // public function minus($product)
        // {
        //     if(array_key_exists($product->id,$this->items))
        //     {

        //         $this->totalQty -= 1 ;
        //         $this->totalPrice -= $product->price;
        //     }
        // }
        public function remove($id)
        {
            if(array_key_exists($id,$this->items))
            {
                $this->totalQty -= $this->items[$id]['qty'];
                $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
                unset($this->items[$id]);

            }
        }
}
