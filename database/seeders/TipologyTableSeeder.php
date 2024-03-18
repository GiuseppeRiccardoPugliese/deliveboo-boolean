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
            ['name' => 'Pizza', 'image' => 'https://co-restaurants.roocdn.com/images/b296a6e9a829c68ec63a5f9c7e6cf26e6a713ab5/shortcut/pizza.png?width=200&height=114&fit=crop&bg-color=00ccbc&auto=webp&format=png'],
            ['name' => 'Italiano', 'image' => 'https://co-restaurants.roocdn.com/images/4aff1c1a46b08a31087781debda9d99e3e696cf8/shortcut/pasta.png?width=200&height=114&fit=crop&bg-color=00ccbc&auto=webp&format=png'],
            ['name' => 'Dessert', 'image' => 'https://co-restaurants.roocdn.com/images/4aff1c1a46b08a31087781debda9d99e3e696cf8/shortcut/dessert.png?width=200&height=114&fit=crop&bg-color=cc3a2f&auto=webp&format=png'], 
            ['name' => 'Poke', 'image' => 'https://co-restaurants.roocdn.com/images/4aff1c1a46b08a31087781debda9d99e3e696cf8/shortcut/poke.png?width=200&height=114&fit=crop&bg-color=fabe00&auto=webp&format=png'],
            ['name' => 'Sandwich', 'image' => 'https://co-restaurants.roocdn.com/images/4aff1c1a46b08a31087781debda9d99e3e696cf8/shortcut/sandwich.png?width=200&height=114&fit=crop&bg-color=cc3a2f&auto=webp&format=png'],
            ['name' => 'Kebab', 'image' => 'https://co-restaurants.roocdn.com/images/4aff1c1a46b08a31087781debda9d99e3e696cf8/shortcut/kebab.png?width=200&height=114&fit=crop&bg-color=440063&auto=webp&format=png'],
            ['name' => 'Sushi', 'image' => 'https://co-restaurants.roocdn.com/images/b296a6e9a829c68ec63a5f9c7e6cf26e6a713ab5/shortcut/sushi.png?width=200&height=114&fit=crop&bg-color=440063&auto=webp&format=png'],
            ['name' => 'Hamburger', 'image' => 'https://co-restaurants.roocdn.com/images/4aff1c1a46b08a31087781debda9d99e3e696cf8/shortcut/burgers.png?width=200&height=114&fit=crop&bg-color=00ccbc&auto=webp&format=png'],
            ['name' => 'Americano', 'image' => 'https://co-restaurants.roocdn.com/images/4aff1c1a46b08a31087781debda9d99e3e696cf8/shortcut/american.png?width=200&height=114&fit=crop&bg-color=007e8a&auto=webp&format=png'],
            ['name' => 'Healthy', 'image' => 'https://co-restaurants.roocdn.com/images/4aff1c1a46b08a31087781debda9d99e3e696cf8/shortcut/organic.png?width=200&height=114&fit=crop&bg-color=8c0062&auto=webp&format=png'],
        ];
        foreach ($tipologies as $tipology) {

            $new_tipology = new Tipology();

            $new_tipology->name = $tipology['name'];
            $new_tipology->image = $tipology['image'];


            //Salvo
            $new_tipology->save();
        }
    }
}
