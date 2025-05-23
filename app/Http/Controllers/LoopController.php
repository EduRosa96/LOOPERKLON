<?php

namespace App\Http\Controllers;

use App\Models\Loop;
use App\Models\Tag;
use Illuminate\Http\Request;


class LoopController extends Controller
{
    public function byTag(Tag $tag, Request $request)
    {
        $query = $tag->loops()->with('user', 'tags')->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('key_signature', 'like', "%$search%")
                    ->orWhere('bpm', 'like', "%$search%")
                    ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%$search%"))
                    ->orWhereHas('tags', fn($t) => $t->where('name', 'like', "%$search%"));
            });
        }


        $loops = $query->get();

        return view('loops.index', compact('loops', 'tag'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('loops.create', compact('tags'));
    }

    public function list(Request $request) // <- Renombrado para evitar conflicto
    {
        $query = Loop::with('user', 'tags')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $loops = $query->get();

        return view('loops.index', compact('loops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'bpm' => 'nullable|integer',
            'key_signature' => 'nullable|string|max:10',
            'filename' => 'required|file|mimes:mp3,wav',
        ]);

        $filename = $request->file('filename')->store('loops', 'public');

        $loop = Loop::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'bpm' => $request->input('bpm'),
            'key_signature' => $request->input('key_signature'),
            'filename' => $filename, // ← Aquí el valor correcto
            'user_id' => auth()->id(),
        ]);

        if ($request->filled('tags')) {
            $tagsJson = $request->input('tags');
            $tagsArray = collect(json_decode($tagsJson))->pluck('value')->toArray();

            $tagIds = collect($tagsArray)
                ->filter(fn($tag) => trim($tag) !== '')
                ->unique()
                ->map(fn($tagName) => Tag::firstOrCreate(['name' => trim($tagName)])->id);

            $loop->tags()->sync($tagIds);
        }

        return redirect()->route('loops.index')->with('success', 'Loop subido correctamente');
    }
}
