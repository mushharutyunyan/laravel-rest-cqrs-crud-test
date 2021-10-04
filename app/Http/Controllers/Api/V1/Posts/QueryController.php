<?php

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostFilterRequest;
use App\Http\Resources\PostsResource;
use App\Http\Response\ClientResponse;
use App\Models\Post;

class QueryController extends Controller
{
    /**
     * @param PostFilterRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(PostFilterRequest $request)
    {
        $data = $request->all();
        $posts = new Post();
        if($request->exists('search')) {
            $posts = $posts->where('title','LIKE','%'.$data['search'].'%');
        }
        if($request->exists('date_start')) {
            $posts = $posts->where('created_at','>=',$data['date_start']." 00:00:01");
        }
        if($request->exists('date_end')) {
            $posts = $posts->where('created_at','<=',$data['date_end']." 23:59:59");
        }
        $posts = $posts->orderBy('created_at', 'DESC')->paginate(7);
        return PostsResource::collection($posts);
    }

    /**
     * @param $id
     * @return PostsResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = Post::byHash($id);
        return new PostsResource($post);
    }

}
