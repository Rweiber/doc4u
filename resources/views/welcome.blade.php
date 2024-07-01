@extends('layouts.main')

@section('title', 'Doc 4 you')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque por CRM ou especialidade</h1>
    <form action="/" class='form-bar' method="GET">
        <input type="text" id="search" name= 'search' class="form-control" placeholder='Pesquisar'>
    </form>
    @if ($search)
        @if (count($medicos) > 0)
            <div class="medicos-container"> 
                @foreach ($medicos as $medico)
                    <div class="medico-card">
                        <p>{{ $medico->nome }}</p> 
                        <p>{{ $medico->especialidade->area }}</p> 
                        <p> (CRM: {{ $medico->crm }})</p> 
                    </div>
                @endforeach
                @if (session('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                    </div>
                @endif
            </div>
        @else
            <p>Nenhum médico encontrado para essa especialidade ou CRM.</p>
        @endif
    @endif
</div>

@endsection