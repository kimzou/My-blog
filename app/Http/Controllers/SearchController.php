<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function searchPost(Request $request)
    {
        $keyword = $request->input('search');
   
        return redirect('search/'.$keyword);
    }

    public function results($keyword)
    {
        $posts = Post::where('title', $keyword)
                        ->orWhere('content', 'LIKE', "%$keyword%")
                        ->orWhere('tags', $keyword)
                        ->paginate(5)
                        ->map(function ($post) use ($keyword){
                            $post->title = preg_replace('/' .$keyword. '/i', 
                            '<mark>' .$keyword. '</mark>', $post->title);
                            $post->content = preg_replace('/' .$keyword. '/i', 
                            '<mark>' .$keyword. '</mark>', $post->content);
                            $post->tags = preg_replace('/' .$keyword. '/i', 
                            '<mark>' .$keyword. '</mark>', $post->tags);
                            
                            $post->content = Str::limit($post->content, 200);
                            return $post;
                        });
                        
        return view('search.results', compact('posts', 'keyword'));
    }

    public function highlight($id, $keyword)
    {
        $post = Post::find($id);

        $post->title = preg_replace('/' .$keyword. '/i','<mark>' .$keyword. '</mark>', 
        $post->title);
        $post->content = preg_replace('/' .$keyword. '/i', '<mark>' .$keyword. '</mark>', 
        $post->content);
        $post->tags = preg_replace('/' .$keyword. '/i', '<mark>' .$keyword. '</mark>', $post->tags);

        return view('posts.show-post', compact('post'));
    }
}
