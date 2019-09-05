@extends('layouts.form')
    @section('card')
        @foreach($comments as $comment)
            <ul class="list-group list-group-flush">
                <li class="list-group-item" style="list-style-type: none">
                    {{ $comment->content }} sur le <a href="{{ route('post.show',$comment->post_id) }}">billet</a>
                </li>
            </ul>
        @endforeach
        <br>
        <div class="row">
            <a href="{{ route('admin.home') }}" class="btn btn-outline-dark">
                Retour  
            </a>    
        </div>
        <div class="row justify-content-center">
            {{ $comments->links() }}
        </div>
    @endsection