@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <h4>{{ $competition->tittle }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Data de início:</strong> {{date('d/m/Y H:i', strtotime($competition->start_date)) }}</p>
            <p><strong>Data de término:</strong> {{ date('d/m/Y H:i', strtotime($competition->end_date)) }}</p>
            <p><strong>Data do sorteio:</strong> {{ date('d/m/Y H:i', strtotime($competition->raffle_date)) }}</p>

            @if ($competition->is_active)
            <p><strong>Status:</strong><span class="badge badge-success">Ativo</span></p>
            @else
            <p><strong>Status:</strong><span class="badge badge-danger">Cancelado</span></p>
            @endif
        </div>
    </div>
</div>
@endsection