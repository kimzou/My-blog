<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\{User, Post, Comment};

class AdminController extends Controller
{
    public function home()
    {
        $lastUsers = User::latest()->limit(10)->get();
        $lastPosts = Post::latest()->limit(10)->get();
        $lastComments = Comment::latest()->limit(10)->get();

        return view('admin.home-admin', compact('lastUsers', 'lastPosts', 'lastComments'));
    }

    public function showUser($id)
    {
        $user = User::find($id);

        return view('admin.show-user-admin', compact('user'));
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(3);

        return view('admin.users-admin', compact('users'));
    }

    public function posts()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);

        return view('posts.index-post', compact('posts'));
    }

    public function comments()
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(3);

        return view('admin.comments-admin', compact('comments'));
    }

    public function softDelete($id)
    {
        User::find($id)->delete();
        
        return redirect()->back();
    }
}
