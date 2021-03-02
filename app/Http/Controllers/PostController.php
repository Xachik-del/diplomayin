<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostStoreRequest;
use App\Models\BlogPost;
use App\Models\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = BlogPost::query()->where('status', 1)->with(['author', 'category', 'comments.author'])->paginate(3);

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
            $post = $request->get('id') ? BlogPost::query()->findOrFail($request->get('id')) : new BlogPost();
            $post->title = $request->get('title');
            $post->content = $request->get('description');
            $post->category_id = $request->get('category_id');
            $post->is_published = $request->get('is_published');
            $post->published_at = $request->get('is_published') ? now() : null;
            $post->status = 1;
            $post->user_id = auth()->id();
            $post->save();

            return response()->json([
                'success' => true,
                'post' => $post->load(['author', 'category', 'comments.author']),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'post' => null,
                'message' => $e->getMessage(),
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BlogPost $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(BlogPost $post)
    {
        if ($post) {
            return response()->json([
                'success' => true,
                'post' => $post->load(['author', 'comments.author']),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'post' => null,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogPost $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BlogPost $post)
    {
        if ($post) {
            try {
                $post->status = 0;
                $post->is_published = 0;
                $post->published_at = null;
                $post->save();
                $post->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Post successfully deleted.',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong.',
                ]);
            }
        }
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserPosts()
    {
        $posts = BlogPost::getUserPosts(auth()->id())->with(['author', 'category'])->paginate(3);
        return response()->json([
            'success' => true,
            'posts' => $posts,
        ]);
    }


    public function addComment(Request $request, BlogPost $post)
    {
        try {
            $validated = Validator::make($request->all(), [
                'comment' => 'required'
            ])->validate();

            $post->comments()->create([
                'text' => $request->get('comment'),
                'user_id' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'comments' => $post->comments,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'comments' => $post->comments(),
                'message' => 'Something went wrong',
            ]);
        }
    }


    public function getRelatedPosts(BlogPost $post)
    {
        return response()->json([
           'success' => true,
           'relatedPosts' => $post->related(),
        ]);
    }

    public function getFeaturedPosts()
    {
        return response()->json([
            'success' => true,
            'featured_posts' => BlogPost::query()->where('is_featured', '1')->take(3)->get(),
        ]);
    }

    public function getRecentPosts()
    {
        return response()->json([
            'success' => true,
            'recent_posts' => BlogPost::query()->orderBy('published_at', 'desc')->take(4)->get() ,
        ]);
    }

    public function getPopularPosts()
    {
        return response()->json([
            'success' => true,
            'popular_posts' => BlogPost::query()->orderBy('views', 'desc')->take(3)->get() ,
        ]);
    }
}
