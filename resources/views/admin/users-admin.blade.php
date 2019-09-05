@extends('layouts.form')
    @section('card')
        @foreach($users as $user)
                @component('components.card')
                    @slot('title')
                        <a href="{{ route('admin.showUser', $user->id) }}">{{ $user->username }}</a>
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
        @endforeach
        <div class="row">
            <a href="{{ route('admin.home') }}" class="btn btn-outline-dark">
                Retour  
            </a>    
        </div>
        <div class="justify-content-center row">
            {{ $users->links() }}
        </div>
    @endsection