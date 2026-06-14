<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function show(Category $category)
{
    $colors = [
        'linear-gradient(135deg, #f5c842, #e8a800)',
        'linear-gradient(135deg, #f87171, #dc2626)',
        'linear-gradient(135deg, #fb923c, #ea580c)',
        'linear-gradient(135deg, #7eb8f7, #4a90d9)',
        'linear-gradient(135deg, #7ed99a, #3ab865)',
        'linear-gradient(135deg, #b8a0f0, #8060d0)',
        'linear-gradient(135deg, #f7a8c4, #e06090)',
    ];
    $color = $colors[$category->id % count($colors)];
    $entries = $category->entries()->orderBy('entry_date', 'desc')->get();
    return view('entries.category', compact('category', 'entries', 'color'));
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string',
        ]);

        Category::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'color' => $request->color,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string',
        ]);

        $category->update($request->only('name', 'color'));

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}