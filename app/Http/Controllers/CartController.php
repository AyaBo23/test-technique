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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {

        $data = $request->validate([
            'id' => 'required|exists:articles',
            'quantity' => 'required|min:1',
        ]);

        $article = Article::find($data['id']);

        //On vérifie si l'article existe déjà dans le panier
        $existsInCart = $cart->articles()->where('article_id', $article->id)->exists();

        // Si l'article n'existe pas dans le panier on l'ajoute: 
        if (!($existsInCart)) {
            $cart->articles()->attach($article, ['quantity' => $data['quantity']]);   
        }

        //Si l'article existe on met à jour sa quantité
        else {
            $currentQuantity = $cart->articles()->where('article_id', $article->id)->first()->pivot->quantity;

            //On ne doit pas dépasser la quantité d'articles dans le stock
            $newQuantity = min($article->stock_quantity, $currentQuantity + $data['quantity']);

            $cart->articles()->updateExistingPivot($article->id, ['quantity' => $newQuantity]);

        }
        return 'Article Added Successfully!';

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

    public function getCartItems()
    {
        $cartArticles = auth()->user()->cart->articles()->withPivot('quantity')->get();
        return $cartArticles;
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

    /**
     * Supprimer l'article choisi du panier d'achat
     */
    public function removeCartArticle(Request $request, Cart $cart, Article $article) {
        $cart->articles()->detach($article);
        return 'Article deleted Successfully';
    }
}
