<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Flasher\Prime\FlasherInterface;

class CategoryController extends Controller
{
    public function index()
    {
        return view('layouts.posts.category.index', [
            'categories' => Category::get(['id', 'name'])
        ]);
    }

    public function create()
    {
        return view('layouts.posts.category.create');
    }

    public function store(Category $category, CategoryRequest $request, FlasherInterface $flasher)
    {
        $category->create($request->validated());
        $flasher->addSuccess('Category added successfully!');
        return redirect('/admin/categories');
    }

    public function edit(Category $category)
    {
        return view('layouts.posts.category.edit', ['category' => $category]);
    }

    public function update(Category $category, CategoryRequest $request, FlasherInterface $flasher)
    {
        $category->update($request->validated());
        $flasher->addSuccess('Category updated successfully!');
        return redirect('/admin/categories');
    }

    public function destroy(Category $category, FlasherInterface $flasher)
    {
        $category->delete();
        $flasher->addSuccess('Category deleted successfully!');
        return redirect('/admin/categories');
    }
}
