@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Edit Profile') }}</h5>
            </div>
            <form method="post" action="{{ route('profile.update') }}" autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @method('put')

                    @include('alerts.success')
                    <input type="hidden" name="id" value="{{ old('id', $user->id) }}">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label>{{ __('Email address') }}</label>
                        <input type="email" name="email" required class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', $user->email) }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label>{{ __('Name') }}</label>
                        <input type="text" required name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}">
                        @include('alerts.feedback', ['field' => 'name'])
                    </div>
                    <div class="form-group{{ $errors->has('cpf') ? ' has-danger' : '' }}">
                        <label>{{ __('Cpf') }}</label>
                        <input type="text" required name="cpf" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" placeholder="{{ __('Cpf') }}" value="{{ old('cpf', $user->cpf) }}">
                        @include('alerts.feedback', ['field' => 'cpf'])
                    </div>
                    <div class="form-group{{ $errors->has('birth_date') ? ' has-danger' : '' }}">
                        <label>{{ __('Data de Nascimento') }}</label>
                        <input type="date" required name="birth_date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" placeholder="{{ __('Data de Nascimento') }}" value="{{ old('birth_date', $user->birth_date) }}">
                        @include('alerts.feedback', ['field' => 'birth_date'])
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                        <label>{{ __('Telefone') }}</label>
                        <input type="text" required name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Telefone') }}" value="{{ old('phone', $user->phone) }}">
                        @include('alerts.feedback', ['field' => 'phone'])
                    </div>
                    <div class="form-group{{ $errors->has('nationality') ? ' has-danger' : '' }}">
                        <label>{{ __('Nacionalidade') }}</label>
                        <input type="text" required name="nationality" class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" placeholder="{{ __('Nacionalidade') }}" value="{{ old('nationality', $user->nationality) }}">
                        @include('alerts.feedback', ['field' => 'nationality'])
                    </div>

                    <div class="form-group{{ $errors->has('responsible') ? ' has-danger' : '' }}">
                        <label>{{ __('Nome do Responsável') }}</label>
                        <input type="text" required name="responsible" class="form-control{{ $errors->has('responsible') ? ' is-invalid' : '' }}" placeholder="{{ __('Responsável') }}" value="{{ old('responsible', $user->responsible) }}">
                        @include('alerts.feedback', ['field' => 'responsible'])
                    </div>
                    <div class="form-group{{ $errors->has('kinship_level') ? ' has-danger' : '' }}">
                        <label>{{ __('Nível de Parentesco') }}</label>
                        <select required name="kinship_level" class="form-control{{ $errors->has('kinship_level') ? ' is-invalid' : '' }}" placeholder="{{ __('Nível de parentesco') }}" value="{{ old('kinship_level', $user->kinship_level) }}">
                            @include('alerts.feedback', ['field' => 'kinship_level'])
                            <option value="">Selecione</option>
                            <option value="pai">Pai</option>
                            <option value="mae">Mãe</option>
                            <option value="outros">Outros</option>
                        </select>
                    </div>
                    <div class="form-group{{ $errors->has('photo') ? ' has-danger' : '' }}">
                        <button type="button" class="btn btn-fill btn-primary">
                            <label>{{ __('Foto') }}</label>
                            <input type="file" required name="photo" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" placeholder="{{ __('Foto') }}" value="{{ asset( auth()->user()->photo)}}">
                            @include('alerts.feedback', ['field' => 'photo'])
                        </button>
                    </div>
                    <input type="checkbox" id="terms" name="terms" value="1">
                    <label for="terms">Eu autorizo o uso da minha imagem dentro do sistema </label>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Password') }}</h5>
            </div>
            <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                <div class="card-body">
                    @csrf
                    @method('put')

                    @include('alerts.success', ['key' => 'password_status'])

                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                        <label>{{ __('Current Password') }}</label>
                        <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                        @include('alerts.feedback', ['field' => 'old_password'])
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label>{{ __('New Password') }}</label>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                    <div class="form-group">
                        <label>{{ __('Confirm New Password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-user">
            <div class="card-body">
                <p class="card-text">
                <div class="author">
                    <div class="block block-one"></div>
                    <div class="block block-two"></div>
                    <div class="block block-three"></div>
                    <div class="block block-four"></div>
                    <a href="#">
                        <img class="avatar" src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ __('Foto') }}">

                        <h5 class="title">{{ auth()->user()->name }}</h5>
                    </a>
                    <p class="description">
                        @foreach ($permissions as $permission)
                        {{ $permission->name }}
                        @endforeach
                    </p>
                </div>
                </p>

            </div>

        </div>
    </div>
</div>
@endsection