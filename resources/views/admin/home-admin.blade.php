@extends('layouts.form')
    @section('content')
        <h4 class="text-center">10 derniers utilisateurs :</h4>
        <div class="container col-6">
            @if(isset($lastUsers))
                @foreach($lastUsers as $user)
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
            @endif
            <div class="justify-content-center row">
                <a href="{{ route('admin.users') }}" class="btn btn-secondary">Liste de tous les utlisateurs</a>
            </div>
        </div>
        <hr>
        <h4 class="text-center">10 derniers posts :</h4>
        <div class="container col-6">
            @if(isset($lastPosts))
                @foreach($lastPosts as $post)
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
                            @if(Auth::id() === $post->user_id || Auth::user()->role === 'admin')
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
                            <p class="text-center">
                                <a href="{{ route('post.show', $post->id) }}">
                                    Voir les commentaires
                                    <span class="badge badge-primary badge-pill">{{ $post->comments->count() }}</span>
                                </a>
                            </p>
                        </div>
                    @endcomponent
                @endforeach
            @endif
            <div class="justify-content-center row">
                <a href="{{ route('admin.posts') }}" class="btn btn-secondary">Liste de tous les billets</a>
            </div>
        </div>
        <hr>
        <div class="container col-6">
            <h4 class="text-center">10 derniers commentaires :</h4>
            @foreach($lastComments as $comment)
                <ul class="list-group">
                    <li class="list-group-item" style="background-color: #343a40;color: white; list-style-type: none; border-bottom: 1px #B0C4DE solid">
                        <a href="{{ route('post.show', $comment->post_id) }}">{{ $comment->content }}</a>
                        par <strong><a href="{{ route('admin.showUser', $comment->user->id) }}">{{ $comment->user->username }}</strong></a>
                    </li>
                </ul>
                <br>
            @endforeach
            <div class="justify-content-center row">
                <a href="{{ route('admin.comments') }}" class="btn btn-secondary">Liste de tous les commentaires</a>
            </div>
        </div>
    @endsection
