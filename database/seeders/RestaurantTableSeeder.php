<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $restaurants = [
        //     [
        //         'name' => 'Pizzeria Bella Napoli',
        //         'piva' => '01234567890',
        //         'address' => 'Via Roma, 1',
        //         'image' => '/img/img00.jpg',
        //         'visible' => true,
        //     ],
        //     [
        //         'name' => 'Ristorante La Trattoria',
        //         'piva' => '09876543210',
        //         'address' => 'Corso Italia, 15',
        //         'image' => '/img/img01.jpg',
        //         'visible' => true,
        //     ],
        //     [
        //         'name' => 'Osteria Garibaldi',
        //         'piva' => '11223344557',
        //         'address' => 'Piazza Garibaldi, 10',
        //         'image' => '/img/img02.jpg',
        //         'visible' => false,
        //     ],
        //     [
        //         'name' => 'Ristorante da Mario',
        //         'piva' => '11223344556',
        //         'address' => 'Via Garibaldi, 20',
        //         'image' => '/img/img03.jpg',
        //         'visible' => true,
        //     ],
        //     [
        //         'name' => 'Trattoria dei Sapori',
        //         'piva' => '98765432101',
        //         'address' => 'Corso Vittorio Emanuele, 5',
        //         'image' => '/img/img04.jpg',
        //         'visible' => true,
        //     ],
        //     [
        //         'name' => 'Il Buongustaio',
        //         'piva' => '54321678909',
        //         'address' => 'Via Dante Alighieri, 30',
        //         'image' => '/img/img05.jpg',
        //         'visible' => false,
        //     ],
        //     [
        //         'name' => 'Ristorante al Duomo',
        //         'piva' => '65432109870',
        //         'address' => 'Piazza Duomo, 1',
        //         'image' => '/img/img06.jpg',
        //         'visible' => true,
        //     ],
        //     [
        //         'name' => 'La Locanda del Gusto',
        //         'piva' => '09876543211',
        //         'address' => 'Via Milano, 12',
        //         'image' => '/img/img07.jpg',
        //         'visible' => false,
        //     ],
        //     [
        //         'name' => 'Trattoria Toscana',
        //         'piva' => '76543210987',
        //         'address' => 'Corso Cavour, 8',
        //         'image' => '/img/img08.jpg',
        //         'visible' => true,
        //     ],
        //     [
        //         'name' => 'Ristorante da Giorgio',
        //         'piva' => '54321098765',
        //         'address' => 'Piazza Repubblica, 25',
        //         'image' => '/img/img09.jpg',
        //         'visible' => false,
        //     ],
        // ];

        // Restaurant::count(10)
        //     ->make() //NELLA relazione ONE to MANY si utilizza il make()
        //             //NELLA relazione MANY to MANY si utilizza il create
        //     ->each(function ($restaurant) {

        //         $user = User::inRandomOrder()->first();
        //         $event -> user() -> associate($user);

        //         $event->save();

        //         $tags = Tag::inRandomOrder()->take(3)->get();
        //         $event->tags()->attach($tags);
        //     });

        $users = User::inRandomOrder()->get();

        // foreach ($restaurants as $restaurant) {

        //     $new_restaurant = new Restaurant();

        //     // Prendi un utente casuale
        //     $user = $users->shift(); // Rimuovi l'utente dalla lista per evitare il riassegnamento

        //     $new_restaurant->user()->associate($user);

        //     $new_restaurant->name = $restaurant['name'];
        //     $new_restaurant->piva = $restaurant['piva'];
        //     $new_restaurant->address = $restaurant['address'];
        //     $new_restaurant->image = $restaurant['image'];
        //     $new_restaurant->visible = $restaurant['visible'];

        //     //Salvo
        //     $new_restaurant->save();
        // }
    }
}
