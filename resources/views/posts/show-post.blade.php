@extends('layouts.app')
    @section('content')
        <a href="{{ route('post.index') }}" class="btn btn-outline-dark">
            Retour  
        </a>
        <div class="justify-content-center row">
            <div class="col-6">
                @component('components.card')
                    @slot('title')
                        {!! $post->title !!}
                    @endslot
                    {!! $post->content !!}
                    <div class="card-footer text-muted">
                        @if(isset($post->tags)) 
                                <p class="font-weight-bold">
                                    #{!! $post->tags !!}
                                </p>
                            @endif
                        <p>
                            par <span class="italic">{{ $post->user->username }}</span>                
                            ({{ $post->created_at->format('d/m/Y h:m') }})
                        </p>
                        @if(Auth::id() != null && (Auth::id() === $post->user_id || Auth::user()->role === 'admin'))
                            <div class="justify-content-center row">
                                <button class="btn btn-warning">
                                    <a href="{{ route('post.edit', $post->id) }}" style="text-decoration: none; color: white; padding-right: 25px">
                                        Modifier le billet
                                    </a>
                                </button>
                                <form method="POST" action="{{ route('post.delete', $post->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" onclick="return confirm('Voulez vous supprimer le billet ?')">
                                        Supprimer le billet
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endcomponent
                </div>
            </div>
        </div>
        @auth
            <div class="justify-content-center row">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Ajouter un commentaire
                </button>
            </div>
        @endauth
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Ecrire un commentaire
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('comment.store', $post->id) }}">
                            @csrf
                            <div class="form-row align-items-center">
                                <textarea name="content" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="justify-content-center">
                                <button type="submit" class="btn btn-secondary">
                                    Publier ce commentaire
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($comments) && count($comments) !== 0) 
            <div class="container col-6">
                <ul class="list-group list-group-flush">
                    @foreach($comments as $comment)
                        <li class="list-group-item" style="list-style-type: none; border-bottom: 1px #B0C4DE solid">
                            <p id="{{ $comment->id }}">
                                <strong>{{ $comment->user->username }}</strong> : {{ $comment->content }}</p>
                            <p class="text-muted">{{ $comment->created_at->format('d/m/Y h:m') }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="justify-content-center row">
                {{ $comments->links() }}
            </div>
        @else
            <p class="text-center">Il n'y a aucun commentaires pour ce billet.</p>
        @endif
    @endsection