<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $totalPrice = $this->calculateTotalPrice($cart);
        
        return view('cart.show', compact('cart', 'totalPrice'));
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
            'article' => 'required',
            'quantity' => 'required|min:1'
        ]);

        $article = Article::find($data['article']);

        //On vérifie si l'article existe déjà dans le panier
        $existsInCart = $cart->articles()->where('article_id', $article->id)->exists();

        // Si l'article n'existe pas dans le panier on l'ajoute: 
        if (!($existsInCart)) {
            $cart->articles()->attach($article, ['quantity' => $data['quantity']]);
        }

        //Si l'article existe on met à jour sa quantité
        else {
           $cart->articles()->syncWithoutDetaching([$article->id => ['quantity' => $data['quantity']]]);
        }
        
        return redirect(route('cart.show', $cart));

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

    /**
     * Calculer le prix total dans le panier
     */
    public function calculateTotalPrice(Cart $cart) {

        $cartArticles = $cart->articles()->get();

        $totalPrice = 0;

        foreach($cartArticles as $cartArticle) {
            $totalPrice += $cartArticle->price * $cartArticle->pivot->quantity;
        }

        return $totalPrice;
    }

}
