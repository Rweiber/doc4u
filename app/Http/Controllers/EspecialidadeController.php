<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Especialidade;

class EspecialidadeController extends Controller
{
    public function index()
{
    $especialidade = Especialidade::all();

    return view('especialidades', ['especialidade' => $especialidade]);
}

    
}
