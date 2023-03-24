<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $currentUser = Auth::user();
        $post = post::findOrFail($request->id);

        if($post -> author != $currentUser->id){
            return response()->json([
                'messages' => 'Anda bukan pemilik Post'
            ],404);
        }
        
        return $next($request);
    }
}