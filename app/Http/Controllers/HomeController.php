<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Cache::remember('posts-page-' . request('page', 1), now()->addMonth(1), function () {
            return $this->latestPosts()->filter(request(['search']))->paginate(6);
        });
        $featureds = Cache::remember('posts', now()->addMonth(1), function () {
            return $this->latestPosts()->where('featured', '1')->get();
        });
        return view('front.index', [
            'posts' => $posts,
            'featureds' => $featureds
        ]);
    }

    public function show()
    {
        $post = Cache::remember('post', now()->addMonth(1), function () {
            return $this->latestPosts()->where('slug', request('slug'))->first();
        });

        return view('front.details', [
            'post' => $post
        ]);
    }

    public function latestPosts()
    {
        return Post::latest()->with(['categories', 'author', 'comments'])->withCount('allComments');
    }

    public function categoriesIndex()
    {
        $category = new Category();
        return $this->catAuthorQuery($category, 'author', 'categories');
    }

    public function authorsIndex()
    {
        $user = new User();
        return $this->catAuthorQuery($user, 'categories', 'authors');
    }

    protected function catAuthorQuery($model, $term, $viewKey)
    {
        $query = $model::where('name', request('slug'))->firstOrFail();
        $posts = $query->posts()->latest()->with($term, 'comments')->withCount('allComments');

        return view("front.show-$viewKey", [
            'posts' => $posts->filter(request(['search']))->paginate(6)
        ]);
    }
}
