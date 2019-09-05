@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Connexion')
        @endslot
        <form method="POST" action="{{ route('login') }}">
            @csrf
            @include('partials.form-group', [
                'title' => __('Nom d\'utilisateur'),
                'type' => 'text',
                'name' => 'username',
                'required' => true,
            ])
            @include('partials.form-group', [
                'title' => __('Mot de passe'),
                'type' => 'password',
                'name' => 'password',
                'required' => true,
            ])
            <button type="submit" class="btn btn-primary btn-block">Connexion</button>
        </form>
    @endcomponent
@endsection
