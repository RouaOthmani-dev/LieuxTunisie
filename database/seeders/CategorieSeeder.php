<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;


class categorieseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $categories=[
        ['id'=>1,'nom'=>'Désert & Oasis'],
        ['id'=>2,'nom'=>'Mer & Côte'],
        ['id'=>3,'nom'=>'Montagnes & Forêts'],
        ['id'=>4,'nom'=>'Villes & Architecture'],
        ['id'=>5,'nom'=>'Studios & Salles intérieures'],
       ];
       foreach($categories as $categorie){
        Categorie::updateOrCreate(['id' => $categorie['id']], $categorie);
       }
    }
}
