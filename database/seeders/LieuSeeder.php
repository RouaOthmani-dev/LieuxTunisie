<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lieu;

class LieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $lieus = [
             [
        'nom' => 'Douz',
        'categorie_id' => 1, // Désert & Oasis
        'description' => 'Douz, surnommée la "porte du désert", offre des dunes dorées à perte de vue, des palmeraies tranquilles et une lumière naturelle exceptionnelle. Ce lieu est parfait pour les tournages de films d’aventure, documentaires sahariens ou spots publicitaires au style exotique. Il a notamment servi de décor à plusieurs scènes du film *Le Patient anglais* et à divers documentaires du National Geographic.',
        'region' => 'Kebili',
        'adresse' => 'Douz centre',
        'image' => 'Douz.png',
    ],
    [
        'nom' => 'Tozeur',
        'categorie_id' => 1,
        'description' => 'Tozeur mêle tradition et splendeur désertique : architecture en briques ocre, oasis luxuriantes, et les décors mythiques de Star Wars à proximité. Parfait pour les productions de science-fiction, films ethniques ou scènes mystiques. C’est ici qu’ont été tournées des scènes emblématiques de *Star Wars: Un Nouvel Espoir* et *Indiana Jones et les Aventuriers de l’arche perdue*.',
        'region' => 'Tozeur',
        'adresse' => 'Tozeur ville',
        'image' => 'Tozeur.png',
    ],
    [
        'nom' => 'Djerba',
        'categorie_id' => 2, // Mer & Côte
        'description' => 'Djerba, île envoûtante du sud tunisien, combine plages dorées, maisons blanches à coupoles, et ambiance méditerranéenne paisible. C’est un lieu idéal pour les clips musicaux, tournages lifestyle et publicités balnéaires. Elle est également connue pour avoir accueilli des scènes du film *Star Wars: Un Nouvel Espoir*, notamment la maison de Luke Skywalker.',
        'region' => 'Médenine',
        'adresse' => 'Houmt Souk',
        'image' => 'Djerba.png',
    ],
    [
        'nom' => 'Tabarka',
        'categorie_id' => 3, // Montagnes & Forêts
        'description' => 'Tabarka propose une nature sauvage et verdoyante avec ses forêts de pins, falaises abruptes et plages aux rochers rouges. Ce cadre naturel se prête bien aux documentaires, scènes de randonnée ou récits fantastiques. Elle a été utilisée dans plusieurs documentaires écologiques et d’exploration diffusés sur Arte et la BBC.',
        'region' => 'Jendouba',
        'adresse' => 'Tabarka Nord',
        'image' => 'Tbarka.png',
    ],
    [
        'nom' => 'Zaghouan',
        'categorie_id' => 3,
        'description' => 'Entre montagnes majestueuses et vestiges romains, Zaghouan offre une richesse visuelle remarquable. Idéal pour les reconstitutions historiques, vidéos de nature et films d’aventure. Ce site a inspiré plusieurs productions locales et documentaires historiques, notamment ceux de la chaîne tunisienne Wataniya 1.',
        'region' => 'Zaghouan',
        'adresse' => 'Centre-ville',
        'image' => 'Zaghouan.png',
    ],
    [
        'nom' => 'El Djem',
        'categorie_id' => 4, // Villes & Architecture
        'description' => 'El Djem est célèbre pour son amphithéâtre romain, l’un des mieux conservés au monde. Le site incarne la grandeur de l’Empire romain et accueille idéalement des productions historiques ou des scènes épiques. Il a été utilisé dans le film *Gladiator* (scènes inspirées), ainsi que dans de nombreux documentaires sur l’Empire romain.',
        'region' => 'Mahdia',
        'adresse' => 'Rue de l’Amphithéâtre',
        'image' => 'Eljam.png',
    ],
    [
        'nom' => 'Tunis Studio Cinéma',
        'categorie_id' => 5, // Studios & Salles intérieures
        'description' => 'Ce studio professionnel en plein cœur de Tunis est équipé pour les productions vidéo de haute qualité : décors modulables, éclairages de cinéma, et loges de maquillage. Parfait pour les spots TV, les interviews, ou les projets avec contrôle total de l’environnement. Il a accueilli de nombreux tournages de séries tunisiennes, de publicités internationales et d’émissions télévisées populaires comme *Labès*.',
        'region' => 'Tunis',
        'adresse' => 'Rue du Cinéma',
        'image' => 'Studio.png',
    ],
     ];

foreach($lieus as $lieu){
    Lieu::create($lieu);
}
}
}