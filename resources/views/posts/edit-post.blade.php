@extends('layouts.form')
@section('card')
    <a href="{{ route('post.index') }}" class="btn btn-outline-dark">
        Retour  
    </a>
    @component('components.card')
        @slot('title')
            Modifier le billet
        @endslot
        <form method="POST" action="{{ route('post.update', $post->id) }}">
            @csrf
            @method('put')
            @include('partials.form-group', [
                'title' => 'Titre :',
                'type' => 'text',
                'name' => 'title',
                'value' => $post->title,
                'required' => false,
            ])
            <textarea name="content" id="article-ckeditor" cols="30" rows="10">{!! $post->content !!}</textarea>
            @include('partials.form-group', [
                'title' => 'tags',
                'type' => 'text',
                'name' => 'tags',
                'value' => $post->tags ?? '',
                'required' => false,
            ])
            <div class="justify-content-center row">
                <button class="btn btn-secondary btn-block">
                    Modifier le billet
                </button>
            </div>
        </form>
        <form method="POST" action="{{ route('post.delete', $post->id) }}">
            @csrf
            @method('delete')
            <div class="justify-content-center row">
                <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Voulez vous supprimer ce billet ?')">
                    Supprimer le billet
                </button>
            </div>
        </form>
    @endcomponent
@endsection
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    window.document.onload = function () {
        CKEDITOR.replace( 'article-ckeditor' );
    }
</script>