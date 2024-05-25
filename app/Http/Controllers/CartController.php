<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
class CartController extends Controller
{
    public function index(){
        $cartItems = Cart::instance('cart')->content(); 
        return view("cart",["cartItems"=>$cartItems]);
    }

    // public function addToCart(Request $request)
    // {
    //     $product = Product::find($request->id);
    //     $price = $product->sale_price ? $product->sale_price : $product->regular_price;
    //     Cart::instance('cart')->add($product->id,$product->name,$request->quantity,$price)->associate('App\Models\Product');


    //     return redirect()->back()->with('message','Success ! Item has been added successfully!');
    // } 
    public function AddToCart(Request $request){
        $product = Product::find($request->id);
        if ($product !== null) {
            $price = $product->sale_price ? $product->sale_price : $product->regular_price;
            
        } else {
            // Handle the case where $product is null
        }
        
        //$price = $product->sale_price ? $product->sale_price : $product->regular_price;
        if ($product !== null) {
            Cart::instance('cart')->add($product->id,$product->name,$request->quantity,$price)->associate('App\Models\Product');
        } else {
            
        }
        return redirect()->back()->with('message','Item has been added succesfully');
        // Cart::instance('cart')->add($product->id,$product->name,$request->quantity,$price)->associate('App\Models\Product');
        // return redirect()->back()->with('message','Item has been added succesfully');
    }
    public function updateProduct(Request $request){
        Cart::instance('cart')->update($request->rowId,$request->quantity);
        return redirect()->route('cart.index');
    }
    public function removeItem(Request $request){
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }
    public function clearCart(){
        Cart::instance('')->destroy();
        return redirect()->route('cart.index');
    }
}

 