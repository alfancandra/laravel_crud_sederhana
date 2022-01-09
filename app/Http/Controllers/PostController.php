<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    public function add()
    {
        return view('posts.add');
    }

    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required',
            'content' => 'required'
        ]);

        try{
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'status' => 1,
            ]);

            return redirect()->route('posts')->with([
                'success' => 'New post has been created successfully'
            ]);
        } catch (QueryException $e) {
            return redirect()->route('addpost')->with(['error' => $e->errorInfo]);
        }
    }
}
