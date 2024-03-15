<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RestaurantRequest;
use App\Models\Restaurant;
use App\Models\Tipology;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();

        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $tipologies = Tipology::all();
        $users = User::all();

        return view('restaurants.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantRequest $request, $id)
    {
        $data = $request->all();

        //Gestione IMG
        $img = $data['image'];
        $img_path = Storage::disk('public')->put('images', $img);

        //Prendo l'ID dello USER
        $user = User::find($id);

        $restaurant = new Restaurant();
        $restaurant->name = $data['name'];
        $restaurant->piva = $data['piva'];
        $restaurant->image = $img_path;
        $restaurant->address = $data['address'];
        $restaurant->visible = isset($data['visible']) ? true : false;

        $restaurant->user()->associate($user);

        $restaurant->save();

        return redirect()->route('restaurant.index');
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
        // Trova il ristorante da eliminare
        $restaurant = Restaurant::find($id);
        $restaurant->delete();

        return redirect()->route('restaurant.index');
    }
}
