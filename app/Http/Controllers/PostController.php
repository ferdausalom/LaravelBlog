<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Flasher\Prime\FlasherInterface;

class PostController extends Controller
{
    public function index()
    {
        return view('layouts.dashboard', [
            'posts' => Post::get(['id', 'title', 'thumbnail', 'status'])
        ]);
    }

    public function create()
    {
        return view('layouts.posts.create', ['categories' => Category::get(['id', 'name'])]);
    }

    public function store(Post $post, PostRequest $request, FlasherInterface $flasher)
    {
        $post->storePost($request);
        $flasher->addSuccess('Post added successfully!');
        return redirect('/admin');
    }

    public function edit(Post $post)
    {
        $post->load('categories');

        return view('layouts.posts.edit', [
            'post' => $post,
            'postCategories' => $post->categories->pluck('id')->toArray(),
            'categories' => Category::get(['id', 'name'])
        ]);
    }

    public function update(Post $post, PostRequest $request, FlasherInterface $flasher)
    {
        $post->storePost($request);
        $flasher->addSuccess('Post updated successfully!');
        return redirect('/admin');
    }

    public function destroy(Post $post, FlasherInterface $flasher)
    {
        $post->delete();
        $flasher->addSuccess('Post deleted successfully!');
        return redirect('/admin');
    }
}
