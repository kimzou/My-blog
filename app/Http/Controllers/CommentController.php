<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Comment, Post};

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $data = $request->validate(['content' => 'required|string']);
        $data['post_id'] = $id;
        $data['user_id'] = $request->user()->id;
        
        Comment::create($data);
           
        return redirect()->back()->with('success', 'Commentaire ajouté !');
    }
}
