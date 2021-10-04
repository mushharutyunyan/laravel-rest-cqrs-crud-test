<?php

namespace App\Http\Middleware;

use App\Http\Response\ClientResponse;
use App\Models\Post;
use Closure;
use Illuminate\Http\Request;

class PostExistsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('id');
        if(!Post::byHash($id)) {
            return ClientResponse::error('Post not found',404);
        }
        return $next($request);
    }
}
