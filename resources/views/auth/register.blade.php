@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Inscription')
        @endslot
        <form method="POST" action="{{ route('register') }}">
            @csrf
            @include('partials.form-group', [
                'title' => __('Nom d\'utilisateur'),
                'type' => 'text',
                'name' => 'username',
                'required' => true,
            ])
            @include('partials.form-group', [
                'title' => __('Adresse email'),
                'type' => 'email',
                'name' => 'email',
                'required' => true,
            ])
            @include('partials.form-group', [
                'title' => __('Prénom'),
                'type' => 'text',
                'name' => 'name',
                'required' => true,
            ])
            @include('partials.form-group', [
                'title' => __('Nom'),
                'type' => 'text',
                'name' => 'lastname',
                'required' => true,
            ])
            @include('partials.form-group', [
                'title' => __('Date de naissance'),
                'type' => 'date',
                'name' => 'birthdate',
                'required' => true,
            ])
            @include('partials.form-group', [
                'title' => __('Mot de passe'),
                'type' => 'password',
                'name' => 'password',
                'required' => true,
            ])
            @include('partials.form-group', [
                'title' => __('Confirmation du mot de passe'),
                'type' => 'password',
                'name' => 'password_confirmation',
                'required' => true,
            ])
            <button type="submit" class="btn btn-primary btn-block">Inscription</button>
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Mot de passe oublié ?
            </a>
        </form>
    @endcomponent
@endsection