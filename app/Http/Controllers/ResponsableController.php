<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responsable;

class ResponsableController extends Controller
{
    //Store Responsable
    public function store(Request $request){
        return Responsable::agregarResponsable($request);
    }
}
