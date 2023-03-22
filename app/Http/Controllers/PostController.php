<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailPostResourc;
use App\Http\Resources\PostResourc;
use App\Models\post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index(){
        $posts = post :: all();
        return PostResourc::collection($posts);
    }

    public function id($id)
    {
        $post = Post::findOrFail($id);
        return new DetailPostResourc($post);
    }
}