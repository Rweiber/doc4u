<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Especialidade; 

class MedicoController extends Controller
{

    public function getMedicosByEspecialidade($id)
    {
        $medicos = Medico::where('especialidade_id', $id)->get();
        return response()->json($medicos);
    }


}