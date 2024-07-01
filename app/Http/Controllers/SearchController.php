<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidade;
use App\Models\Medico;

class SearchController extends Controller
{

    public function index()
    {
        $search = request('search');

        $especialidades = []; 

        if ($search) {
            // Busca por CRM
            $medicos = Medico::where('crm', 'like', '%' . $search . '%')->get();
            if ($medicos->isEmpty()) {
                // Busca por especialidade se não encontrar por CRM
                $especialidades = Especialidade::where('area', 'like', '%' . $search . '%')->get();
                foreach ($especialidades as $especialidade) {
                    $medicos = Medico::where('especialidade_id', $especialidade->id)->get();
                }
            }
        } else {
            $especialidades = Especialidade::all(); // Se não houver pesquisa, traga todas as especialidades
            $medicos = []; 
        }

        return view('welcome', ['especialidades' => $especialidades, 'medicos' => $medicos, 'search' => $search]);
    }
}