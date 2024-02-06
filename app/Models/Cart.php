<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongTo(User::class);
    }

    public function articles() {
        return $this->belongsToMany(Article::class)->withPivot('quantity');
    }

}
