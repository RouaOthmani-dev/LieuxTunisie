<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Lieu extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom',
        'categorie_id',
        'description',
        'image',
        'region',
        'adresse',
        'latitude',
        'longitude',
    ];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
