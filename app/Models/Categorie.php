<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = ['nom'];
    public function lieux()
    {
        // Relation : Une catégorie peut avoir plusieurs lieux
        return $this->hasMany(Lieu::class);
    }
}
