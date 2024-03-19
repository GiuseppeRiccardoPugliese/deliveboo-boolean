<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\Tipology;

class ApiDataController extends Controller
{
    public function Data()
    {
        // Recupera tutti i ristoranti dal database con le relazioni pre-caricate
        $restaurants = Restaurant::with('tipologies')->with('dishes')->get();

        // Costruisci un array contenente tutti i dati
        $data = [];

        // Cicla sui ristoranti e organizza i dati nel formato desiderato
        foreach ($restaurants as $restaurant) {
            // Recupera tutti i tipi per il ristorante corrente
            $types = $restaurant->tipologies->pluck('name')->toArray();

            // Recupera tutti i piatti per il ristorante corrente
            $menu = Dish::where('restaurant_id', $restaurant->id)->get();

            // Costruisci la struttura completa dei dati per ciascun ristorante
            $restaurantData = [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'piva' => $restaurant->piva,
                'address' => $restaurant->address,
                'image' => $restaurant->image,
                'visible' => $restaurant->visible,
                'user_id' => $restaurant->user_id,
                'tipologies' => $types,
                'dishes' => $menu,
            ];

            // Aggiungi i dati del ristorante all'array principale
            $data[] = $restaurantData;
        }

        // Restituisci i dati come risposta JSON
        return response()->json($data);
    }
    public function filteredTipology(Request $request) //FUNZIONE PER LA CHIAMATA DEL FILTRO DELLE TIPOLOGIEEEEEEEEE!!!!
    {
        $tipologies = $request->input('tipology');

        $restaurants = Restaurant::with('user', 'tipologies')->get();

        $filteredRestaurants = $restaurants->filter(function ($restaurant) use ($tipologies) {
            if (empty($tipologies)) {
                return true; // Restituisci il ristorante se nessuna tipologia è selezionata
            }

            $restaurantTipologies = $restaurant->tipologies->pluck('name')->toArray();

            return count(array_intersect($tipologies, $restaurantTipologies)) === count($tipologies);
        });

        if ($filteredRestaurants->isEmpty()) {
            return response()->json([
                'messaggio' => 'Nessun ristorante trovato!',
                'restaurants' => [],
            ]);
        } else {
            return response()->json([
                'messaggio' => 'Ristoranti trovati',
                'restaurants' => $filteredRestaurants,
            ]);
        }
    }
}
