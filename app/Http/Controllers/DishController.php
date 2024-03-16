<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Dish;
use App\Models\Restaurant;

use Illuminate\Http\Request;
use App\Http\Requests\DishRequest;
use App\Http\Requests\EditDishRequest;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();
        return view('dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dishes = Dish::all();
        return view('dishes.create', compact('dishes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishRequest $request)
    {

        $data = $request->all();

        //Gestione IMG
        $img = $data['image'];
        $img_path = Storage::disk('public')->put('images', $img);

        $user = Auth::user();
        $restaurant_id = $user->restaurant->id;

        $dish = new Dish();

        $dish->name = $data['name'];
        $dish->description = $data['description'];
        $dish->price = $data['price'];
        $dish->image = $img_path; //CREO LA IMG
        $dish->visible = isset($data['visible']) ? true : false;

        $dish->restaurant_id = $restaurant_id;
        $dish->save();

        return redirect()->route('dish.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dish = Dish::find($id);
        return view('dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish = Dish::find($id);
        return view('dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditDishRequest $request, $id)
    {
        $data = $request->all();

        //Gestione IMG
        // $img = $data['image'];
        // $img_path = Storage::disk('public')->put('images', $img);

        $user = Auth::user();
        $restaurant_id = $user->restaurant->id;

        $dish = Dish::find($id);

        $dish->name = $data['name'];
        $dish->description = $data['description'];
        $dish->price = $data['price'];

        if ($request->hasFile('image')) {
            // Carica l'immagine e salva il percorso
            $img_path = $request->file('image')->store('images', 'public');

            // Aggiorna il percorso dell'immagine nel modello dell'insegnante
            $dish->image = $img_path;
        }

        // $dish->image = $img_path; //CREO LA IMG
        $dish->visible = isset($data['visible']) ? true : false;

        $dish->restaurant_id = $restaurant_id;
        $dish->save();

        return redirect()->route('dish.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);
        $dish->delete();

        return redirect()->route('dish.index');
    }
}
