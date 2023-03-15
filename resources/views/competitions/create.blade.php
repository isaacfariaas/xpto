@extends('layouts.app', ['page' => __('Bolsão'), 'pageSlug' => 'icons'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            
<div class="card-header">
                <h5 class="title">{{ __('Criar Bolsão') }}</h5>
            </div>
            <form method="POST" action="{{ route('competition.store') }}">
                <div class="card-body">
                @csrf    
                @include('alerts.success')

                   
                    <div class="form-group">
                        <label>{{ __('Título') }}</label>
                        <input type="text" required name="tittle" class="form-control" placeholder="{{ __('Título') }}">
                        @include('alerts.feedback', ['field' => 'tittle'])
                    </div>
                    
                    <div class="form-group">
                        <label>{{ __('Início das Inscrições') }}</label>
                        <input type="date" required name="start_date" class="form-control" placeholder="{{ __('Início das inscrições') }}" >
                        @include('alerts.feedback', ['field' => 'start_date'])
                    </div>
                    <div class="form-group">
                        <label>{{ __('Fim das Inscrições') }}</label>
                        <input type="date" required name="end_date" class="form-control" placeholder="{{ __('Fim das Inscrições') }}" >
                        @include('alerts.feedback', ['field' => 'end_date'])
                    </div>
                    <div class="form-group">
                        <label>{{ __('Data do sorteio') }}</label>
                        <input type="date" required name="raffle_date" class="form-control" placeholder="{{ __('Data do sorteio') }}" >
                        @include('alerts.feedback', ['field' => 'raffle_date'])
                    </div>
                    <div class="form-group">
                        <label>{{ __('Quantidade de bolsas') }}</label>
                        <input type="number" required name="scholarship_amount" class="form-control" placeholder="{{ __('Quantidade de bolsas') }}" >
                        @include('alerts.feedback', ['field' => 'scholarship_amount'])
                    </div>
                
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-fill btn-primary">{{ __('Enviar') }}</button>
                </div>
            </form>
        </div>


        </div>
    </div>
</div>
</div>
@endsection