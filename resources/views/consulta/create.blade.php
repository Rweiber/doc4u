@extends('layouts.main')

@section('title', 'Doc 4 you - Agendar Consulta')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h2>Agendar Consulta</h2>

    <form action="/consultas" method="POST">
        @csrf

        <div class="form-group">
            <label for="paciente_id">Paciente:</label>
            <select name="paciente_id" id="paciente_id" class="form-control">
                <option value="">Selecione um paciente</option>
                @foreach ($pacientes as $paciente)
                    <option value="{{ $paciente->id }}">{{ $paciente->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="medico_id">Médico:</label>
            <select name="medico_id" id="medico_id" class="form-control">
                <option value="">Selecione um médico</option>
                @foreach ($medicos as $medico)
                    <option value="{{ $medico->id }}">{{ $medico->nome }} - {{ $medico->especialidade->area }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="data_consulta">Data da Consulta:</label>
            <input type="date" name="data_consulta" id="data_consulta" class="form-control">
        </div>

        <div class="form-group">
            <label for="hora_consulta">Hora da Consulta:</label>
            <input type="time" name="hora_consulta" id="hora_consulta" class="form-control">
        </div>

        <div id="responsavel_fields" style="display: none;">
            <div class="form-group">
                <label for="nome_responsavel">Nome do Responsável</label>
                <input type="text" class="form-control" id="nome_responsavel" name="nome_responsavel" value="{{ old('nome_responsavel') }}">
            </div>
            <div class="form-group">
                <label for="cpf_responsavel">CPF do Responsável</label>
                <input type="text" class="form-control" id="cpf_responsavel" name="cpf_responsavel" value="{{ old('cpf_responsavel') }}">
            </div>
        </div>

        <button type="submit" class="btn2 btn-primary">Agendar Consulta</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#paciente_id').on('change', function() {
            var pacienteId = $(this).val();
            if (pacienteId) {
                $.ajax({
                    url: '/pacientes/' + pacienteId, 
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Calcula a idade do paciente
                        var idade = calcularIdade(data.data_nascimento);

                        // Exibe o campo CPF do responsável se o paciente for menor de 18 anos
                        if (idade < 18) {
                            $('#responsavel_fields').show();
                        } else {
                            $('#responsavel_fields').hide();
                        }

                        // Filtra os médicos por especialidade (Pediatria) se o paciente for menor de 12 anos
                        if (idade < 12) {
                            $('#medico_id option').each(function() {
                                var medicoEspecialidade = $(this).text().split(' - ')[1]; // Obtém a especialidade do texto da opção
                                if (medicoEspecialidade !== 'Pediatria') {
                                    $(this).hide();
                                } else {
                                    $(this).show();
                                }
                            });
                        } else {
                            $('#medico_id option').show(); // Exibe todas as opções de médicos
                        }
                    },
                    error: function(xhr) {
                        console.log('Erro ao buscar dados do paciente:', xhr);
                    }
                });
            } else {
                $('#responsavel_fields').hide();
                $('#medico_id option').show(); // Exibe todas as opções de médicos
            }
        });

        // Função para calcular a idade a partir da data de nascimento
        function calcularIdade(dataNascimento) {
            var nascimento = new Date(dataNascimento);
            var hoje = new Date();
            var idade = hoje.getFullYear() - nascimento.getFullYear();
            var m = hoje.getMonth() - nascimento.getMonth();
            if (m < 0 || (m === 0 && hoje.getDate() < nascimento.getDate())) {
                idade--;
            }
            return idade;
        }
    });
</script>

@endsection
