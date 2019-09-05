@extends('layouts.form')
    @section('card')
        @component('components.card')
            @slot('title')
                Ajouter un post
            @endslot
            <form method="POST" action="{{ route('post.store') }}">
                @csrf
                @include('partials.form-group', [
                    'title' => 'Titre :',
                    'type' => 'text',
                    'name' => 'title',
                    'required' => true,
                ])
                <textarea name="content" id="article-ckeditor" cols="30" rows="10"></textarea>
                @include('partials.form-group', [
                    'title' => 'Tags',
                    'type' => 'text',
                    'name' => 'tags',
                    'required' => false,
                ])
                <button type="submit" class="btn btn-secondary btn-block">Publier ce billet</button>
            </form>
        @endcomponent
    @endsection
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>