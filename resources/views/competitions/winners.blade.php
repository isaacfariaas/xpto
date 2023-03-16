@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($winners as $competition)
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $competition->tittle }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $competition->tittle }}</h6>
                            <p class="card-text">{{ $competition->winners->count() }} Ganhador(es)</p>
                            @foreach($competition->winners as $winner)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $winner->created_at->format('d/m/Y') }}</h6>
                                        <p class="card-text">{{ $winner->subscribe->user->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection