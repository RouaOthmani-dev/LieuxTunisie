<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorieSeeder::class,
            LieuSeeder::class,
            ExpertSeeder::class,
        ]);

        User::updateOrCreate(
    ['email' => 'admin@admin.com'], // critère de recherche
    [
        'name' => 'admin',
        'password' => bcrypt('123abcd!=ef45'),
        'is_admin' => true,
    ]
);
    $this->call(BlogSeeder::class);



    }
}

