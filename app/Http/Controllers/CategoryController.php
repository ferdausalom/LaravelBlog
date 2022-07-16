<?php

namespace App\Http\Controllers;

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

    public function store(Category $category, FlasherInterface $flasher)
    {
        $request = $this->validateCategory();
        $category->create($request);
        $flasher->addSuccess('Category added successfully!');
        return redirect('/admin/categories');
    }

    public function edit(Category $category)
    {
        return view('layouts.posts.category.edit', ['category' => $category]);
    }

    public function update(Category $category, FlasherInterface $flasher)
    {
        $request = $this->validateCategory();
        $category->update($request);
        $flasher->addSuccess('Category updated successfully!');
        return redirect('/admin/categories');
    }

    protected function validateCategory()
    {
        $request = request()->validate([
            'name' => ['required', Rule::unique('categories', 'name')]
        ]);

        $request['name'] = strtolower($request['name']);
        return $request;
    }

    public function destroy(Category $category, FlasherInterface $flasher)
    {
        $category->delete();
        $flasher->addSuccess('Category deleted successfully!');
        return redirect('/admin/categories');
    }
}
