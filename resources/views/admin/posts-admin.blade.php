@extends('layouts.form')
    <a href="{{ route('admin.home') }}" class="btn btn-outline-dark">
        Retour  
    </a>
    @section('card')
        @foreach($posts as $post)
            @component('components.card')
                @slot('title')
                    <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                @endslot
                {{ $post->content }}
                <div class="card-footer text-muted">
                    @if(isset($post->tags)) 
                        <p class="font-weight-bold">
                            #{!! $post->tags !!}
                        </p>
                    @endif
                    <p>
                        par <span class="italic">{{ $post->user->username }}</span>                
                        <span class="text-right">{{ $post->created_at }}</span>
                    </p>
            @endcomponent
        @endforeach
    @endsection