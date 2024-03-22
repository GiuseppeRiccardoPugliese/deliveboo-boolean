<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;
use App\Models\Tipology;
use App\Models\Restaurant;
// use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class TipologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipologie = Tipology::all();

        // Puoi quindi restituire la vista con i dati necessari
        return view('tipologie.create', compact('tipologie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione dei dati inviati dal form
        $request->validate([
            'type' => 'array', // Assicurati che 'type' sia un array
        ]);
    
        // Ottenere i tipi selezionati dall'utente
        $selectedTypes = $request->input('type', []);
    
        // Associare le tipologie selezionate al ristorante
        $restaurant = Auth::user()->restaurant; // Assumendo che l'utente autenticato abbia un ristorante associato
        $restaurant->tipologies()->sync($selectedTypes);
    
        // Redirect alla pagina desiderata dopo il salvataggio
        return redirect()->route('nome_della_rotta');
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
        //
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
