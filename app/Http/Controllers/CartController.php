<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Article;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   /* public function index(Request $request)
    {
        //$cartItems = auth()->user()->cart()->articles()->get();

    }*/

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        return view('cart.show', compact('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $data = $request->validate([
            'id' => 'required',
            'label' => 'required',
            'price' => 'required',
            'stock_quantity' => 'required|min:1'
        ]);
       // return $data;
        //On vérifie si l'article existe déjà dans le panier
        $existsInCart = $cart::find($data['id']);
        if (!$existsInCart) {
            $quantity = 1;
            $cart->articles()->attach($data['id']);
        }
        else {
            return $existsInCart;
        }
    
        return 'Product Added successfully!';

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }

    /**
     * Get the current Cart Id
     */
    public function getCurrentCart() 
    {
        return auth()->user()->cart;
    }

}
