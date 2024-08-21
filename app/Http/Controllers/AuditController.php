<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;

class AuditController extends Controller
{
    /**
     * Get audit 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        return response()->json(Audit::all());
    }
}
