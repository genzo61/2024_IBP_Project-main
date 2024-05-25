<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
class WishlistController extends Controller
{
    public function getwishlistedproduct(){
        $items = Cart::instance("wishlist")->content();
        return view("wishlist", compact("items"));
    }
    public function addtoproducttowishlist(Request $request){
        Cart::instance("wishlist")->add($request->id,$request->name,1,$request->price)->associate("App\Models\Product");
        return response()->json(['status'=>200,'message'=>'success ! item successfully added to your wishlist.']);
    }

    public function removeproductfromwishlist(Request $request){
        $rowId = $request->rowId;
        Cart::instance('wishlist')->remove($rowId);
        return redirect()->route('wishlist.list');
    }
    public function clearwishlist(Request $request){
        Cart::instance('wishlist')->destroy();
        return redirect()->route('wishlist.list');
    }

    public function movetocart(Request $request){
        $item = Cart::instance('wishlist')->get($request->rowId);
        Cart::instance('wishlist')->remove($request->rowId);
        Cart::instance('cart')->add($item->model->id,$item->model->name,1,$item->model->regular_price)->associate("App\Models\Product");
        return redirect()->route('wishlist.list');
    }
}
