<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tipology;

class TipologiesApiController extends Controller
{
    public function index() {

        $tipologies = Tipology::all(); 

        return response()->json($tipologies);
    }
}
