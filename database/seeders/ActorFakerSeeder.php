<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        //Obtenemos el último id insertado
        $lastInsertedId = DB::table("actors")->max("id");
        //Generamos 20 elementos de tipo aleatorio.
        for ($i = $lastInsertedId; $i < $lastInsertedId + 10; $i++) {
            DB::table("actors")->insert(
                [
                    "id" => $i + 1,
                    //Creamos descuentos de hasta el 100% con dos decimales
                    "name" => $faker->firstName(),
                    "surename" => $faker->lastName(),
                    "birtdate" => $faker->date(),
                    "country" => $faker->country(),
                    "img_url" => $faker->imageUrl(),
                    "created_at" => now()->setTimezone("Europe/Madrid")

                ]
            );
        }
    }
}
