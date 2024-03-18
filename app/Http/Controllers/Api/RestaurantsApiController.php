<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Restaurant;

class RestaurantsApiController extends Controller
{
    public function index()
    {

        $restaurants = Restaurant::with('tipologies')->get();

        return response()->json($restaurants);
    }
}
