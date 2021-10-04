<?php

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostRequest;
use App\Http\Resources\PostsResource;
use App\Http\Response\ClientResponse;
use App\Models\Post;

class CommandController extends Controller
{
    /**
     * @param PostRequest $request
     * @return PostsResource|\Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        $post = new Post();
        if (!$this->_save($post, $data)) {
            return ClientResponse::error('Something went wrong... Please try later', 500);
        }
        return new PostsResource($post);
    }

    public function update(PostRequest $request, $id)
    {
        $data = $request->all();
        $post = Post::byHash($id);
        if (!$this->_save($post, $data)) {
            return ClientResponse::error('Something went wrong... Please try later', 500);
        }
        return new PostsResource($post);
    }

    public function delete($id)
    {
        $post = Post::byHash($id);
        $post->delete();
        return ClientResponse::success('Post removed successfully');
    }

    /**
     * @param Post $post
     * @param array $data
     * @return bool
     */
    public function _save(Post &$post, array $data)
    {
        $post->title = $data['title'];
        $post->body = $data['body'];
        try {
            $post->save();
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
