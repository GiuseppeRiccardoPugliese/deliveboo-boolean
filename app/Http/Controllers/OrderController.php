<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::whereHas('restaurant', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Ottenere i dati dalla richiesta
        $data = $request->all();
        // dd($data);
        // Generare un numero d'ordine casuale
        $number_order = rand(100000, 999999); // Genera un numero casuale a sei cifre

        // Aggiungi il numero d'ordine casuale e l'ID del ristorante ai dati
        // $data['number_order'] = $number_order;
        // $data['restaurant_id'] = // Ottieni l'ID del ristorante da dove vuoi

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id)
    {
        // Ottieni l'ordine dal database
        $order = Order::find($id);

        // Verifica se l'ordine esiste
        if (!$order) {
            return response()->json(['message' => 'Ordine non trovato'], 404);
        }

        // Aggiorna i dettagli dell'ordine con i dati inviati dal frontend
        $order->update($request->all());

        // Rispondi al frontend confermando che l'ordine è stato aggiornato con successo
        return response()->json(['message' => 'Ordine aggiornato con successo', 'order' => $order]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
