<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Post $post)
    {
        $posts = Cache::remember('posts-page-' . request('page', 1), now()->addMonth(1), function () use ($post) {
            return $post->getPosts();
        });
        $featureds = Cache::remember('posts', now()->addMonth(1), function () use ($post) {
            return $post->featuredPosts();
        });
        return view('front.index', [
            'posts' => $posts,
            'featureds' => $featureds
        ]);
    }

    public function show(Post $post)
    {
        $post = Cache::remember('post', now()->addMonth(1), function () use ($post) {
            return $post->getPost();
        });

        return view('front.details', [
            'post' => $post
        ]);
    }

    public function categoryPosts(Post $post)
    {
        $getCatPosts = Cache::remember('categories-page-' . request('page', 1), now()->addMonth(1), function () use ($post) {
            return $post->getCatPosts();
        });

        return view("front.show-categories", [
            'posts' => $getCatPosts
        ]);
    }

    public function authorPosts(Post $post)
    {
        $getAuthorPosts = Cache::remember('authors-page-' . request('page', 1), now()->addMonth(1), function () use ($post) {
            return $post->getAuthorPosts();
        });
        return view("front.show-authors", [
            'posts' => $getAuthorPosts
        ]);
    }
}
