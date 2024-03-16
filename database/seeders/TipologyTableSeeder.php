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
            ['name' => 'Italiano'],
            ['name' => 'Giapponese'],
            ['name' => 'Cinese'],
            ['name' => 'Fast-Food'],
            ['name' => 'Vegetariano'],
            ['name' => 'Vegano'],
        ];
        foreach ($tipologies as $tipology) {

            $new_tipology = new Tipology();

            $new_tipology->name = $tipology['name'];

            //Salvo
            $new_tipology->save();
        }
    }
}
