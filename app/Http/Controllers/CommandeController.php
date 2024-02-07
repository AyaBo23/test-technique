<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $commandes = auth()->user()->commandes()->with('articles')->orderByDesc('created_at')->get();
        if ($request->ajax()) {
           return response()->json($commandes);
        }
        
        return view('commandes.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Liste des articles Commandés: 
        $orderedArticles = auth()->user()->cart->articles()->get();
        $orderedArticlesIds = auth()->user()->cart->articles()->select('id')->get();

        //Prix total de la commande: 
        $price = $request->validate([
            'price' => 'required|numeric|min:0.01'
        ]);

        $userId = auth()->user()->id;

        //On crée la commande 

        $commande = Commande::create([
            'user_id' => $userId,
            'price' => $price['price'],
        ]);

        // On crée la relation entre la commande et les articles commandés avec les quantités commandées: 
        $articlesWithQuantities = [];
        foreach ($orderedArticles as $article) {
            $quantity = $article->pivot->quantity;
            $articlesWithQuantities[$article->id] = ['quantity' => $quantity];
        }
       // $commande->articles()->attach($orderedArticlesIds, ['quantity' => $orderedArticles->pivot->quantity->get()]);

       $commande->articles()->sync($articlesWithQuantities);

       //On vide le panier d'achat
        auth()->user()->cart->articles()->detach();

       return redirect(route('commandes.index'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
