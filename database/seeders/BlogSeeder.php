<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run()
    {
        Blog::updateOrCreate(
            ['slug' => 'top-10-lieux-meconnus-shootings-tunisie'],
            [
                'titre' => 'Top 10 des lieux méconnus pour des shootings en Tunisie',
                'contenu' => 'La Tunisie offre des paysages variés et souvent méconnus qui sont parfaits pour les shootings photos et tournages vidéos :  
- Le village de Chenini, avec ses maisons troglodytes  
- Les oasis de Ksar Ghilane, lieu désertique au charme unique  
- Les ruines antiques de Dougga, classées patrimoine mondial de l’UNESCO  
- La région de Tataouine, souvent utilisée pour des films de science-fiction  
- La plage de Sidi Mahrez à Djerba, encore préservée du tourisme de masse  
- La forêt de Ichkeul, site naturel avec faune et flore riches  
Ces lieux sont idéaux pour des projets créatifs et authentiques.',
                'image' => 'public/storage/10lieu',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        Blog::updateOrCreate(
            ['slug' => 'preparer-tournage-desert-tunisien'],
            [
                'titre' => 'Comment préparer un tournage dans le désert tunisien',
                'contenu' => 'Le désert du Sahara en Tunisie est un décor grandiose mais demande une préparation spécifique :  
- Vérifiez la météo et la température, qui peut être extrême  
- Assurez-vous d’avoir des véhicules tout-terrain fiables  
- Prévoyez suffisamment d’eau et de nourriture pour toute l’équipe  
- Obtenez les autorisations auprès des autorités locales et de la garde nationale  
- Pensez à la sécurité, surtout pour les scènes avec animaux sauvages ou effets spéciaux  
- Collaborez avec un guide local qui connaît bien la région pour optimiser vos déplacements.',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        Blog::updateOrCreate(
            ['slug' => 'interview-realisateur-filme-tunisie'],
            [
                'titre' => 'Interview d’un réalisateur ayant filmé en Tunisie',
                'contenu' => 'Nous avons rencontré Samir Ben Youssef, réalisateur franco-tunisien, qui partage son expérience de tournage en Tunisie :  
“J’ai choisi la Tunisie pour son incroyable diversité de paysages et la qualité de ses équipes techniques. Le désert, les médinas, les plages... tout cela offre une palette exceptionnelle pour créer des ambiances variées.  
Les défis ? Parfois la logistique est compliquée, mais la bonne volonté des locaux compense largement. Je recommande vivement ce pays à tout réalisateur cherchant un cadre authentique.”',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        Blog::updateOrCreate(
            ['slug' => 'reglementations-tournages-etrangers-tunisie'],
            [
                'titre' => 'Les réglementations locales pour les tournages étrangers',
                'contenu' => 'Pour tourner en Tunisie en tant que production étrangère, il faut respecter plusieurs règles :  
- Obtenir une autorisation officielle auprès du Centre Cinématographique Tunisien (CCT)  
- Respecter les zones protégées et sites historiques, souvent soumis à des restrictions  
- Employer un coordinateur local pour faciliter les démarches administratives  
- Assurer la protection des droits d’image et de propriété intellectuelle  
- Respecter la législation sur la sécurité et les assurances du personnel  
Ces étapes garantissent un tournage sans accroc et en conformité avec la loi tunisienne.',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
