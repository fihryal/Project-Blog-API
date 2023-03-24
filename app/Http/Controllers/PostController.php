<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailPostResourc;
use App\Http\Resources\PostResourc;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $posts = post :: all();
        return PostResourc::collection($posts);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return new DetailPostResourc($post);
    }
    
    public function detail($id)
    {
        $post = Post::with('writer:id,username')->findOrFail($id);
        return new DetailPostResourc($post);
    }

    public function store(Request $request)
    {
        $request-> validate([
            'title' => 'required|max:225',
            'content' => 'required'
        ]);

        // return response()->json('sudah dapat di digunakan');

        $request['author'] = Auth::user()->id;

        $post = Post::create($request->all());
        return new DetailPostResourc($post->loadMissing('writer:id,username'));
    }
}