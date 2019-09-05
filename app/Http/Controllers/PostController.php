<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Post, Comment};
use Illuminate\Support\Str;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);

        foreach ($posts as $post) {
            $comments[] = count($post->comments);
        }

        $posts->map(function ($post) {
            $post->content = Str::limit($post->content, 200);
            return $post;
        });

        return view('posts.index-post', compact('posts', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.add-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'bail|required|string|min:1|max:255',
            'content' => 'bail|required|string|min:1',
            'tags' => 'bail|nullable'
        ]);
        $data['user_id'] = $request->user()->id;

        Post::create($data);
        
        return redirect()->route('post.index')->with('success', 'Nouveau billet publié !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->paginate(5);

        return view('posts.show-post', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        
        return view('posts.edit-post', compact('post'));
    }

    public function editMyPosts(Request $request)
    {
        $posts = Post::where('user_id', $request->user()->id)->paginate(5);

        return view('posts.index-post', compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'bail|string|min:1|max:255',
            'content' => 'bail|string|min:1|max:255',
            'tags' => 'bail|string|max:255|nullable'
        ]);

        $post = Post::whereId($id);

        array_filter($data, function ($value) {
            return !$value;
        });

        $post->update($data);

       return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::whereId($id)->delete();
        
        return redirect()->route('post.index')->with('success', 'Billet supprimé');
    }
}
