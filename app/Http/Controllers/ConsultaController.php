<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Especialidade;
use DateTime; // Importar a classe DateTime para usar no cálculo de idade

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with('paciente', 'medico.especialidade')->get();
        return view('consulta.consultas', ['consultas' => $consultas]);
    }

    public function create()
{
    $pacientes = Paciente::all();

    foreach ($pacientes as $paciente) {
        $idade = $this->calcularIdade($paciente->data_nascimento);

        if ($idade < 12) {
            $medicos = Medico::whereHas('especialidade', function ($query) {
                $query->where('id', 3); // Especialidade de pediatria
            })->get();
        } else {
            $medicos = Medico::all();
        }

        // Adicionar a idade de cada paciente aos dados que serão enviados para a view
        $paciente->idade = $idade;
    }

    return view('consulta.create', compact('pacientes', 'medicos'));
}


    // Função para calcular a idade a partir da data de nascimento
    private function calcularIdade($dataNascimento)
    {
        $dataNascimento = new DateTime($dataNascimento);
        $hoje = new DateTime();
        $idade = $hoje->diff($dataNascimento);
        return $idade->y; // Retorna apenas a idade em anos
    }

    public function store(Request $request)
{
    $rules = [
        'paciente_id' => 'required',
        'medico_id' => 'required',
        'data_consulta' => 'required|date',
        'hora_consulta' => 'required', // Novo campo para a hora da consulta
        'cpf_responsavel' => 'nullable|cpf',
    ];

    $request->validate($rules);

    $consulta = new Consulta;
    $consulta->paciente_id = $request->paciente_id;
    $consulta->medico_id = $request->medico_id;
    $consulta->data_consulta = $request->data_consulta;
    $consulta->hora_consulta = $request->hora_consulta; // Salva a hora da consulta
    $consulta->cpf_responsavel = $request->cpf_responsavel;
    $consulta->save();

    return redirect('/consultas');
}
}
