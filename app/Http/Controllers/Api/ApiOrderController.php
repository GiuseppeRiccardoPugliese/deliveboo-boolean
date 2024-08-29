<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Order;



class ApiOrderController extends Controller
{
    public function store(Request $request)
    {
        $number_order = rand(100000, 999999); // Genera un numero casuale a sei cifre

        // Ottenere i dati dalla richiesta
        $data = $request->all();

        Log::info('Dati ricevuti dal frontend:', $data);

        // Salva i dati nel database
        $order = Order::create([
            'number_order' => $number_order,
            'price' => $data['price'],
            'guest_name' => $data['guest_name'],
            'guest_email' => $data['guest_email'],
            'guest_address' => $data['guest_address'],
            'restaurant_id' => $data['restaurant_id'], // Aggiungi l'ID del ristorante
            // Altri campi dell'ordine, se necessario
        ]);

        // Restituisci la risposta appropriata
        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }
}
