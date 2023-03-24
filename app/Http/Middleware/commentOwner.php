<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class commentOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();
        $comment = Comment::findOrFail($request->id);

        if($comment -> user_id != $user->id){
            return response()->json([
                'messages' => 'Anda bukan pemilik comment'
            ],404);
        }
        
        return $next($request);
    }
}