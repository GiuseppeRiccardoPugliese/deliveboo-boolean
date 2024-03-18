<?php

namespace Database\Seeders;

use App\Models\Tipology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipologies = [
            ['name' => 'Pizza'],
            ['name' => 'Italiano'],
            ['name' => 'Dessert'],
            ['name' => 'Poke'],
            ['name' => 'Sandwich'],
            ['name' => 'Kebab'],
            ['name' => 'Sushi'],
            ['name' => 'Hamburger'],
            ['name' => 'Americano'],
            ['name' => 'Healthy'],
        ];
        foreach ($tipologies as $tipology) {

            $new_tipology = new Tipology();

            $new_tipology->name = $tipology['name'];

            //Salvo
            $new_tipology->save();
        }
    }
}
