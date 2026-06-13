<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EntryController extends Controller
{
    public function index(Request $request)
    {
        $query = Entry::where('user_id', auth()->id())->with('category');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        $entries = $query->orderBy('entry_date', 'desc')->get();
        return view('entries.index', compact('entries'));
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('entries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'mood' => 'required',
            'entry_date' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('entries', 'public');
        }

        Entry::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'mood' => $request->mood,
            'image_path' => $imagePath,
            'entry_date' => $request->entry_date,
        ]);

        return redirect()->route('entries.index')->with('success', 'Jurnal berhasil ditambahkan!');
    }

    public function show(Entry $entry)
    {
        return view('entries.show', compact('entry'));
    }

    public function edit(Entry $entry)
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('entries.edit', compact('entry', 'categories'));
    }

    public function update(Request $request, Entry $entry)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'mood' => 'required',
            'entry_date' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $entry->image_path;
        if ($request->hasFile('image')) {
            if ($imagePath) Storage::disk('public')->delete($imagePath);
            $imagePath = $request->file('image')->store('entries', 'public');
        }

        $entry->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'mood' => $request->mood,
            'image_path' => $imagePath,
            'entry_date' => $request->entry_date,
        ]);

        return redirect()->route('entries.index')->with('success', 'Jurnal berhasil diupdate!');
    }

    public function destroy(Entry $entry)
    {
        if ($entry->image_path) {
            Storage::disk('public')->delete($entry->image_path);
        }
        $entry->delete();
        return redirect()->route('entries.index')->with('success', 'Jurnal berhasil dihapus!');
    }
}