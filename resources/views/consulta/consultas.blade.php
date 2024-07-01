@extends('layouts.main')

@section('title', 'Doc 4 you - Especialidades')

@section('content')
<h1>Consultas Agendadas</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th class='consulta_item'>Paciente</th>
            <th class='consulta_item'>Médico</th>
            <th class='consulta_item'>Especialidade</th>
            <th class='consulta_item'>Data da Consulta</th>
            <th class='consulta_item'>Hora da Consulta</th>
            <th class='consulta_item'>Data do Agendamento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($consultas as $consulta)
            <tr>
                <td class='consulta_item'>{{ $consulta->paciente->nome }}</td>
                <td class='consulta_item'>{{ $consulta->medico->nome }}</td>
                <td class='consulta_item'>{{ $consulta->medico->especialidade->area }}</td>
                <td class='consulta_item'>{{ date('d/m/Y', strtotime($consulta->data_consulta)) }}
                <td class='consulta_item'>{{ $consulta->hora_consulta }}</td>
                <td class='consulta_item'>{{ date('d/m/Y - H:i:s', strtotime($consulta->created_at)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection