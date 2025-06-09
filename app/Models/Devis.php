<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom',
        'email',
        'telephone',
        'type_projet',
        'nb_jours',
        'lieu_recherche',
        'budget',
        'message',
        'statut'
    ];
}
