<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expert;

class ExpertSeeder extends Seeder
{
    public function run(): void
    {
        Expert::create([
            'nom' => 'Ahmed Ben Ali',
            'titre' => 'Coordinateur de lieux de tournage en Tunisie',
            'photo' => 'uploads/experts/ahmed.jpg',
            'experience' => 'Plus de 20 ans dans la coordination de tournages internationaux.',
            'films' => 'Star Wars (1977), Indiana Jones (1981), The English Patient (1996)',
            'imdb_link' => 'https://www.imdb.com/name/nm0001234/',
        ]);
    }
}
