<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        //Obtenemos el último id insertado
        $lastInsertedId = DB::table("films")->max("id");
        //Generamos 20 elementos de tipo aleatorio.
        for ($i = $lastInsertedId; $i < $lastInsertedId + 10; $i++) {
            DB::table("films")->insert(
                [
                    "id" => $i + 1,
                    //Creamos descuentos de hasta el 100% con dos decimales
                    "name" => $faker->firstName(),
                    "year" => $faker->year(),
                    "genre" => $faker->randomElement(["Drama", "Terror", "Aventura", "Comedia"]),
                    "country" => $faker->country(),
                    "duration" => $faker->numberBetween(1,200),
                    "img_url" => $faker->imageUrl(),
                    "created_at" => now()->setTimezone("Europe/Madrid")

                ]
            );
        }

    }
}
