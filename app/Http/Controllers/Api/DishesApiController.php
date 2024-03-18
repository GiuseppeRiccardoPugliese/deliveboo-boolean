<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Dish;

class DishesApiController extends Controller
{
    public function index() {

        $dishes = Dish::all(); 

        return response()->json($dishes);
    }
}
