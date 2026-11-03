<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('categories.index', ['categories' => Category::withCount('products')->orderBy('name')->paginate(15)]);
    }

    public function create(): View
    {
        return view('categories.form', ['category' => new Category]);
    }

    public function store(Request $request): RedirectResponse
    {
        Category::create($request->validate(['name' => ['required', 'string', 'max:255', 'unique:categories'], 'description' => ['nullable', 'string', 'max:500']]));

        return redirect()->route('categories.index')->with('success', 'Catégorie créée.');
    }

    public function edit(Category $category): View
    {
        return view('categories.form', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update($request->validate(['name' => ['required', 'string', 'max:255', 'unique:categories,name,'.$category->id], 'description' => ['nullable', 'string', 'max:500']]));

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour.');
    }
}
