@extends('layouts.form')
    @section('card')
        @if(isset($posts))
            @foreach($posts as $post)
                @component('components.card')
                    @slot('title')
                    <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                    @endslot
                    {!! $post->content !!}
                    <div class="card-footer text-muted text-center">
                        @if(isset($post->tags)) 
                            <p class="font-weight-bold">
                                #{!! $post->tags !!}
                            </p>
                        @endif
                        par <span class="italic">{{ $post->user->username }}</span>
                        ({{ $post->created_at }})
                        <p class="text-center">
                            <a href="{{ route('post.show', $post->id) }}">
                                Voir les commentaires
                                <span class="badge badge-primary badge-pill">{{ $post->comments->count() }}</span>
                            </a>
                        </p>
                        @if(Auth::id() != null && (Auth::id() === $post->user_id || Auth::user()->role === 'admin'))
                            <div class="justify-content-center row">
                                <button class="btn btn-warning">
                                    <a href="{{ route('post.edit', $post->id) }}" style="text-decoration: none; color: white">
                                        Modifier ce billet
                                    </a>
                                </button>
                                <form method="POST" action="{{ route('post.delete', $post->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" onclick="return confirm('Voulez vous supprimer ce post ?')">
                                        Supprimer ce billet
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endcomponent
            @endforeach
            <div class="container-fluid">
                <div class="row justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        @else
            <p class="text-center">Il n'y a pas de billets disponibles.</p>
        @endif
    @endsection