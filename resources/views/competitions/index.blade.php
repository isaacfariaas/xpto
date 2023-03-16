@extends('layouts.app', ['page' => __('Bolsão'), 'pageSlug' => 'icons'])

@php
use Illuminate\Support\Facades\Blade;
@endphp

@section('content')
<div class="container">
    <h1>Bolsões</h1>

    <a href="{{ route('competition.create') }}" class="btn btn-primary mb-3">Criar novo bolsão</a>
    <a href="{{ route('competition.winners') }}" class="btn btn-primary mb-3">Últimos Ganhadores</a>
    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Data de início</th>
                <th>Data de término</th>
                <th>Data do sorteio</th>
                <th>Quantidade de bolsas</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($competitions as $competition)
            <tr>
                <td>{{ $competition->tittle }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($competition->start_date)) }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($competition->end_date)) }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($competition->raffle_date)) }}</td>
                <td>{{ $competition->scholarship_amount }}</td>
                <td>
                    @if ($competition->is_active)
                    <span class="badge badge-success">Ativo</span>
                    @else
                    <span class="badge badge-danger">Cancelado</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('competition.show', $competition) }}" class="btn btn-info btn-sm">Detalhes</a>
                    @can('student')
                    <form method="post" action="{{ route('competition.subscribe', ['id' => $competition->id]) }}">
                        @csrf
                        <button class="btn btn-primary btn-sm">Inscrever-se</button>
                    </form>
                    @endcan
                    @can('admin')
                    <form action="{{ route('competition.cancel',['id' => $competition])}}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja cancelar este bolsão?')">Cancelar</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection