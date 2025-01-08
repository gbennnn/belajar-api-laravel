<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            Buku::create([
                'judul' => $faker->sentence(3),
                'pengarang' => $faker->name,
                'tahun_terbit' => $faker->date('Y-m-d'),
            ]);
        }
    }
}