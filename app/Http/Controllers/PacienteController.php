<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
    public function create()
    {
        return view('paciente.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string',
        'cpf' => 'required|unique:pacientes,cpf',
        'telefone' => 'required',
        'email' => 'required|unique:pacientes,email',
        'cep' => 'required',
        'endereco' => 'required',
        'numero' => 'required|integer',
        'data_nascimento' => 'nullable|date',
        'nome_responsavel' => 'nullable|string',
        'cpf_responsavel' => 'nullable|string',
    ]);

    try {
        // Supondo que você tenha uma função para buscar o endereço pelo CEP
        $enderecoData = $this->buscarEnderecoPorCep($request->cep);

        if ($enderecoData) {
            $paciente = new Paciente();
            $paciente->fill([
                'user_id' => auth()->user()->id,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'cep' => $request->cep,
                'endereco' => $enderecoData['logradouro'] ?? $request->endereco,
                'numero' => $request->numero,
                'data_nascimento' => $request->data_nascimento,
                'nome_responsavel' => $request->nome_responsavel,
                'cpf_responsavel' => $request->cpf_responsavel,
                'nome' => $request->nome, // Certifique-se de incluir o campo 'nome' aqui
            ]);
            $paciente->save();

            return redirect('/')->with('success', 'Paciente cadastrado com sucesso!');
        } else {
            Log::error('CEP inválido ou erro na API.');
            return redirect()->back()->with('error', 'CEP inválido ou erro na API.');
        }
    } catch (\Exception $e) {
        Log::error('Erro ao cadastrar paciente: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Erro ao cadastrar paciente: ' . $e->getMessage());
    }
}


    private function buscarEnderecoPorCep($cep)
    {
        // Implementação fictícia da função de busca por CEP
        return [
            'logradouro' => 'Rua Exemplo',
            // Outros dados do endereço
        ];
    }
}
