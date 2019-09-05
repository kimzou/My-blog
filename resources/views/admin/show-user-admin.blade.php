@extends('layouts.form')
    @section('card')
        @component('components.card')
            @slot('title')
                {{ $user->username }}
            @endslot
            <p>
                <strong>Prenom :</strong>
                {{ $user->name }}
            </p>
            <p>
                <strong>Nom :</strong>
                {{ $user->lastname }}
            </p>
            <p>
                <strong>Date de naissance :</strong>
                {{ $user->birthdate }}
            </p>
            <p>
                <strong>Prenom :</strong>
                {{ $user->name }}
            </p>
            <form method="POST" action="{{ route('admin.softDelete', $user->id) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" onclick="return confirm('Voulez vous vraiment supprimer cet utilisateur')">
                            Supprimer cet utilisateur
                        </button>
                    </form>
        @endcomponent
    @endsection
