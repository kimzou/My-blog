@extends('layouts.form')
    @section('card')
        @component('components.card')
            @slot('title')
                Contacter nos admins
            @endslot
            <form action="{{ route('contact.mail') }}" method="POST">
                @csrf
                @include('partials.form-group', [
                    'title' => 'Objet',
                    'type' => 'text',
                    'name' => 'subject',
                    'required' => true,
                ])
                <div>
                    <label for="content">Votre message :</label>
                    <div>
                        <textarea name="content" id="content" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="justify-content-center row">
                    <button class="btn btn-light">
                        Envoyer
                    </button>
                </div>
            </form>
        @endcomponent
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    @endsection