<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    //Ver categorias
    public function viewAll(){
        return Categoria::verTodos();
    }
}
