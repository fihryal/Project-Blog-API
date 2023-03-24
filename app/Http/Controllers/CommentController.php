<?php

namespace App\Http\Controllers;

use App\Http\Resources\commentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request -> validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required'
        ]);

        $request ['user_id'] = Auth()->user()->id;

        $comment = Comment::create($request->all());


        return new commentResource($comment->loadMissing(['commentator:id,username']));
    }

}