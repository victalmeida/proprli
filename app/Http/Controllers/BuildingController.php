<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;


class BuildingController extends Controller
{
    /**
     * Get Building
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json(Building::all());
    }
}
