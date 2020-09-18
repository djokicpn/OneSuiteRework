<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function getPosts() {
        $sortField = request('sort_field','created_at');
        $sortDirection = request('sort_direction','created_at');
        if(!in_array($sortField, ['title','post_text','created_at','updated_at'])) {
            $sortField = 'created_at';
        }
        if(!in_array($sortDirection, ['asc','decs'])) {
            $sortDirection = 'desc';
        }
        $posts = Post::
        when(request('category_id', ''), function($query) {
            $query->where('category_id', request('category_id'));
        })->when(request('title', ''), function($query) {
            $query->where('title', 'like', '%' . request('title') . '%');
        })->when(request('post_text', ''), function($query) {
            $query->where('post_text', 'like',  '%' . request('post_text') . '%');
        })->orderBy($sortField, $sortDirection)->paginate(13);

        return PostResource::collection($posts);
    }
    public function getFilteredPosts() {

        $posts = Post::
        when(request('title', ''), function($query) {
            $query->where('title', 'like', '%' . request('title') . '%');
        })->when(request('post_text', ''), function($query) {
            $query->where('post_text', 'like',  '%' . request('post_text') . '%');
        })
            ->paginate(13);
        return PostResource::collection($posts);
    }
    public function store(StorePostRequest $request) {

        if($request->hasFile('thumbnail')) {
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename);
        }
        $post = Post::create($request->validated());
        return new PostResource($post);
    }

    public function show(Post $post) {
        return new PostResource($post);
    }
    public function update(Post $post, StorePostRequest $request) {

        $post->update($request->validated());

        return new PostResource($post);
    }

    public function destroy(Post $post) {
        $post->delete();
        return response()->noContent();
    }
}
