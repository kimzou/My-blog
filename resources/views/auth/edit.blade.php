@extends('layouts.form')
    @section('card')
        @component('components.card')
            @slot('title')
                Editer le profil
            @endslot
            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('put')
                @include('partials.form-group', [
                    'title' => __('Nom d\'utilisateur'),
                    'type' => 'text',
                    'name' => 'username',
                    'placeholder' => $user->username,
                    'required' => false,
                ])
                @include('partials.form-group', [
                    'title' => __('Adresse email'),
                    'type' => 'email',
                    'name' => 'email',
                    'placeholder' => $user->email,
                    'required' => false,
                ])
                @include('partials.form-group', [
                    'title' => __('Prénom'),
                    'type' => 'text',
                    'name' => 'name',
                    'placeholder' => $user->name,
                    'required' => false,
                ])
                @include('partials.form-group', [
                    'title' => __('Nom'),
                    'type' => 'text',
                    'name' => 'lastname',
                    'placeholder' => $user->lastname,
                    'required' => false,
                ])
                @include('partials.form-group', [
                    'title' => __('Date de naissance'),
                    'type' => 'date',
                    'name' => 'birthdate',
                    'required' => false,
                ])
                @include('partials.form-group', [
                    'title' => __('Mot de passe'),
                    'type' => 'password',
                    'name' => 'password',
                    'placeholder' => '********',
                    'required' => false,
                ])
                @include('partials.form-group', [
                    'title' => __('Confirmation du mot de passe'),
                    'type' => 'password',
                    'name' => 'password_confirmation',
                    'placeholder' => '********',
                    'required' => false,
                ])
                <button type="submit" class="btn btn-primary btn-block">Modifier</button>
            </form>
            <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-block" 
                    onclick="return confirm('Etes-vous certain de vouloir supprimer votre compte ?')">
                        Supprimer mon compte
                    </button>
            </form>
        @endcomponent

    @endsection