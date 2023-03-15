@extends('layouts.app', ['page' => __('Bolsão'), 'pageSlug' => 'icons'])

@php
use Illuminate\Support\Facades\Blade;
@endphp

@section('content')
<div class="row">
    @can('admin')
    <a class="btn col-lg-2 btn-success" href="{{ route('competition.create') }}"> Criar novo Bolsão</a>
</div>
<div class="row">
    @endcan
    @if($competitions=='[]')
    <div class="col-lg-4">
        <div class="card card-chart">
            <div class="card-header">
                <h1 class="card-chart">Sem Bolsões Disponíveis</h1>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="CountryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    @endif
    @foreach ($competitions as $competition)
    <div class="col-lg-4">
        <div class="card card-chart">
            <div class="card-header">
                <h1 class="card">Concurso Bolsão - {{$competition->tittle}}</h1>
                @can('student')
                <form method="post" action="{{ route('competition.subscribe', ['id' => $competition->id]) }}">
                    @csrf
                    @include('alerts.success')
                    <button class="btn col-lg btn-primary" type="submit">Inscreva-se</button>
                </form>
                @endcan
                @can('admin')
                <form method="POST" action="{{ route('competition.destroy', ['competition' => $competition->id]) }}">
                    @csrf
                    @method('DELETE')
                    
                    <button class="btn col-lg btn-danger" type="submit">Cancelar bolsão</button>
                </form>
                @endcan
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="CountryChart"></canvas>
                </div>
            </div>
        </div>
    </div>


    @endforeach
</div>
@endsection