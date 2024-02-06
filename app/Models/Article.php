<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'label', 
        'price',
        'stock_quantity'
    ];

    
    public function carts() {
        return $this->belongsToMany(Cart::class);
    }

    public function commandes() {
        return $this->belongsToMany(Commande::class);
    }



}
