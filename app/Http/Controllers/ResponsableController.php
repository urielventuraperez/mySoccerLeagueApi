<?php

namespace App\Http\Controllers;

use App\Models\Responsable;
use Illuminate\Http\Request;

class ResponsableController extends Controller
{
    public function all()
    {
        return Responsable::verTodosResponsables();
    }

    public function tournament()
    {
        return Responsable::verTorneoResponsables();
    }

    public function tournamentLeader($idResponsable)
    {
        return Responsable::verTorneos($idResponsable);
    }

    //Store Responsable
    public function store(Request $request)
    {
        return Responsable::agregarResponsable($request);
    }

    //Delete Responsable
    public function delete($id)
    {
        return Responsable::eliminarResponsable($id);
    }

    //Update Responsable
    public function update(Request $request, $id)
    {
        return Responsable::actualizarResponsable($request, $id);
    }
}
