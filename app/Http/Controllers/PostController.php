<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResourc;
use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $post = post :: all();
        return PostResourc::collection($post);
    }
}