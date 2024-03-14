<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = [
            [
                'name' => 'Pizza Margherita',
                'description' => 'Pizza classica con pomodoro, mozzarella e basilico fresco.',
                'price' => 8.50,
                'image' => 'pizza_margherita.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Spaghetti alla Carbonara',
                'description' => 'Pasta lunga condita con uovo, pancetta, pepe nero e formaggio Parmigiano.',
                'price' => 12.75,
                'image' => 'spaghetti_carbonara.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Risotto ai Funghi Porcini',
                'description' => 'Risotto cremoso con funghi porcini freschi e Parmigiano Reggiano.',
                'price' => 14.99,
                'image' => 'risotto_funghi.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Lasagne al Forno',
                'description' => 'Piatto tradizionale composto da strati di pasta all\'uovo, ragù, besciamella e Parmigiano.',
                'price' => 10.50,
                'image' => 'lasagne.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Tagliatelle al Ragu',
                'description' => 'Pasta lunga all\'uovo condita con un saporito ragù di carne.',
                'price' => 11.25,
                'image' => 'tagliatelle_ragu.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Cotoletta alla Milanese',
                'description' => 'Cotoletta di vitello impanata e fritta, servita con una fetta di limone.',
                'price' => 16.50,
                'image' => 'cotoletta.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Tortellini in Brodo',
                'description' => 'Pasta ripiena a forma di tortellino servita in un brodo di carne fumante.',
                'price' => 9.75,
                'image' => 'tortellini_brodo.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Bruschetta al Pomodoro',
                'description' => 'Fette di pane tostato condite con pomodoro fresco, aglio, basilico e olio extravergine di oliva.',
                'price' => 7.25,
                'image' => 'bruschetta.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Tiramisù',
                'description' => 'Dolce al cucchiaio composto da strati di savoiardi imbevuti di caffè, crema al mascarpone e cacao amaro.',
                'price' => 6.99,
                'image' => 'tiramisu.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Cannoli Siciliani',
                'description' => 'Dolci tipici della Sicilia a base di pasta fritta ripiena di ricotta dolce e scorze d\'arancia candite.',
                'price' => 8.50,
                'image' => 'cannoli.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Bistecca alla Fiorentina',
                'description' => 'Gustosa bistecca di manzo alla griglia servita con contorno di patate arrosto',
                'price' => 18.99,
                'image' => 'bistecca_fiorentina.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Gnocchi al Gorgonzola',
                'description' => 'Gnocchi di patate con salsa al gorgonzola e noci tostate',
                'price' => 9.50,
                'image' => 'gnocchi_gorgonzola.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Lasagne al Forno',
                'description' => 'Strati di pasta all\'uovo con ragù, besciamella e parmigiano, cotto al forno',
                'price' => 12.50,
                'image' => 'lasagne_forno.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Insalata di Mare',
                'description' => 'Insalata mista con calamari, gamberetti, cozze e vongole, condita con olio e limone',
                'price' => 15.99,
                'image' => 'insalata_mare.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Tagliatelle al Tartufo',
                'description' => 'Tagliatelle fresche condite con salsa al tartufo nero e parmigiano',
                'price' => 18.99,
                'image' => 'tagliatelle_tartufo.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Sushi Maki',
                'description' => 'Gamberetti, avocado e riso insieme a foglioline di alga nori, serviti con salsa di soia e zenzero',
                'price' => 12.99,
                'image' => 'sushi_maki.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Hamburger Bacon Cheese',
                'description' => 'Hamburger di manzo grigliato con formaggio cheddar, bacon croccante, lattuga, pomodoro e salsa barbecue, servito con patatine fritte',
                'price' => 9.50,
                'image' => 'hamburger_bacon_cheese.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Poke Bowl',
                'description' => 'Bowl di riso bianco con cubetti di salmone marinato, avocado, cetrioli, edamame, alghe nori, servito con salsa teriyaki e semi di sesamo',
                'price' => 14.99,
                'image' => 'poke_bowl.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Tacos al Pastor',
                'description' => 'Tortillas di mais farcite con carne di maiale marinata allo spiedo, cipolla, coriandolo, ananas e salsa piccante',
                'price' => 11.50,
                'image' => 'tacos_al_pastor.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Nigiri Sake',
                'description' => 'Risotto al salmone fresco, servito con salsa di soia e zenzero',
                'price' => 10.99,
                'image' => 'nigiri_sake.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Baozi di Maiale',
                'description' => 'Panini al vapore ripieni di maiale cotto a vapore, cipolla caramellata e salsa di soia dolce',
                'price' => 8.50,
                'image' => 'baozi_di_maiale.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Ramen Tonkotsu',
                'description' => 'Zuppa di noodle giapponese a base di osso di maiale con carne di maiale a fette, cipolla verde e uovo sodo',
                'price' => 12.99,
                'image' => 'ramen_tonkotsu.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Pad Thai',
                'description' => 'Tagliatelle di riso saltate in padella con gamberi, tofu, uova, cipolle, germogli di soia e arachidi tritati',
                'price' => 11.50,
                'image' => 'pad_thai.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Panino al Pollo Grigliato',
                'description' => 'Panino con petto di pollo alla griglia, lattuga, pomodoro e maionese, servito con patatine fritte',
                'price' => 7.99,
                'image' => 'panino_pollo_grigliato.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Panino al Prosciutto e Formaggio',
                'description' => 'Panino con prosciutto crudo, formaggio, lattuga, pomodoro e maionese, servito con patatine fritte',
                'price' => 8.50,
                'image' => 'panino_prosciutto_formaggio.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Panino Vegano',
                'description' => 'Panino con burger vegano, lattuga, pomodoro, cetrioli e hummus, servito con patatine dolci',
                'price' => 9.50,
                'image' => 'panino_vegano.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Panino al Tonno e Cipolla',
                'description' => 'Panino con tonno, cipolla rossa, lattuga, pomodoro e maionese, servito con insalata di stagione',
                'price' => 8.99,
                'image' => 'panino_tonno_cipolla.jpg',
                'visible' => true,
            ],
            [
                'name' => 'Panino Club',
                'description' => 'Panino triplo strato con pollo grigliato, bacon, lattuga, pomodoro e maionese, servito con patatine fritte',
                'price' => 10.99,
                'image' => 'panino_club.jpg',
                'visible' => true,
            ],
        ];

        $restaurants = Restaurant::all();

        foreach ($dishes as $dish) {
            // Assicurati che ci siano ristoranti nel database
            if ($restaurants->isEmpty()) {
                // Se non ci sono ristoranti, interrompi il loop
                break;
            }

            $newDish = new Dish();
            $newDish->name = $dish['name'];
            $newDish->description = $dish['description'];
            $newDish->price = $dish['price'];
            $newDish->image = $dish['image'];
            $newDish->visible = $dish['visible'];

            // Seleziona un ristorante casuale
            $randomRestaurant = $restaurants->random();

            // Assegna il piatto al ristorante selezionato
            $newDish->restaurant_id = $randomRestaurant->id;

            $newDish->save();
        }
    }
}
