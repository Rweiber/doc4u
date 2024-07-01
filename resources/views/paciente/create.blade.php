@extends('layouts.main')

@section('title', 'Doc 4 you - Cadastro de Paciente')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h2>Cadastrar Paciente</h2>

    <form action="{{ route('pacientes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nome">Nome do Paciente:</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome do Paciente" value="{{ old('nome') }}">
            @error('nome')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="cpf">CPF do Paciente:</label>
            <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF do Paciente" value="{{ old('cpf') }}">
            @error('cpf')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone" value="{{ old('telefone') }}">
            @error('telefone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text" name="cep" id="cep" class="form-control" placeholder="CEP" value="{{ old('cep') }}">
            @error('cep')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Endereço" value="{{ old('endereco') }}">
            @error('endereco')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="numero">Número:</label>
            <input type="text" name="numero" id="numero" class="form-control" placeholder="Número" value="{{ old('numero') }}">
            @error('numero')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" placeholder="Data de Nascimento" value="{{ old('data_nascimento') }}">
            @error('data_nascimento')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="nome_responsavel">Nome do Responsável (Se necessário):</label>
            <input type="text" name="nome_responsavel" id="nome_responsavel" class="form-control" placeholder="Nome do Responsável" value="{{ old('nome_responsavel') }}">
            @error('nome_responsavel')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="cpf_responsavel">CPF do Responsável (Se necessário):</label>
            <input type="text" name="cpf_responsavel" id="cpf_responsavel" class="form-control" placeholder="CPF do Responsável" value="{{ old('cpf_responsavel') }}">
            @error('cpf_responsavel')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn2">Cadastrar Paciente</button>
    </form>

</div>

<script>
document.getElementById('cep').addEventListener('blur', function() {
    var cep = this.value.replace(/\D/g, '');

    if (cep != "") {
        var validacep = /^[0-9]{8}$/;

        if(validacep.test(cep)) {
            var script = document.createElement('script');

            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            document.body.appendChild(script);
        } else {
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } else {
        limpa_formulário_cep();
    }
});

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        document.getElementById('endereco').value=(conteudo.logradouro);
        
    } else {
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function limpa_formulário_cep() {
    document.getElementById('endereco').value="";
    
}
</script>

@endsection
