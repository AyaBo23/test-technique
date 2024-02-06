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
        $commandes = auth()->user()->commandes()->get();

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
            'price' => 'required'
        ]);

        $userId = auth()->user()->id;

        //On crée la commande 

        $commande = Commande::create([
            'user_id' => $userId,
            'price' => $price['price'],
        ]);

        // On crée la relation entre la commande et les articles commandés avec les quantités commandées: 

       // $commande->articles()->attach($orderedArticlesIds, ['quantity' => $orderedArticles->pivot->quantity->get()]);

       //On vide le panier d'achat
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
