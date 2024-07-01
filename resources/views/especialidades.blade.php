@extends('layouts.main')

@section('title', 'Doc 4 you - Especialidades')

@section('content')

<h1>Ver medicos por especialidade</h1>
<div id="cards-container" class="row">
    @foreach($especialidade as $especialidades)
    <div class="class col-md-3">
        <div class='btn-primary'>{{ $especialidades->area }}</div>

    </div>
    @endforeach

</div>
@endsection
