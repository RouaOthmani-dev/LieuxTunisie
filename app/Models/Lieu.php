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
        'adresse'
    ];
    public function categorie()
    {
        return $this->belongsTo(categorie::class);
    }
}
