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
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required'
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => 1,
        ]);

        if ($post) {
            return redirect()->route('posts')->with([
                'success' => 'Berhasil Tambah Data'
            ]);
        }else{
            return redirect()->route('addpost')->with([
                'error' => 'Gagal'
            ]);
        }
        
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post) {
            return redirect()->route('posts')->with([
                'success' => 'Sukses Hapus'
            ]);
        }else{
            return redirect()->route('addpost')->with(['error' => 'Gagal Hapus']);
        }
    }

    public function edit($id)
    {
        $post = Post::where('id',$id)->first();
        return view('posts.edit',compact('post'));
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required'
        ]);

        $id = $request->id;

        $post = Post::findOrFail($id);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => 1,
        ]);

        if ($post) {
            return redirect()->route('posts')->with([
                'success' => 'Sukses Hapus'
            ]);
        }else{
            return redirect()->route('addpost')->with(['error' => 'Gagal Hapus']);
        }
    }
}
