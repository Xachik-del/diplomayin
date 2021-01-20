<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostStoreRequest;
use App\Models\BlogPost;
use App\Models\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = BlogPost::query()->where('status', 1)->with(['author', 'category'])->paginate(1);

        return response()->json([
            'success' => true,
            'posts' => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BlogPostStoreRequest $request)
    {
        try {
            $post = new BlogPost();
            $post->title = $request->get('title');
            $post->content = $request->get('description');
            $post->category_id = $request->get('category_id') ?? 1;
            $post->is_published = 1;
            $post->published_at = now();
            $post->status = 1;
            $post->user_id = auth()->id();
            $post->save();

            return response()->json([
                'success'=> true,
                'post' => $post->load(['author','category']),
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success'=> false,
                'post' => null,
                'message' => $e->getMessage(),
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Post $post
     * @return Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        //
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserPosts()
    {
        $posts = BlogPost::getUserPosts(auth()->id())->with(['author', 'category'])->paginate(1);
        return response()->json([
            'success' => true,
            'posts' => $posts,
        ]);
    }
}
