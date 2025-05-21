<?php

namespace App\Http\Controllers;

use App\Models\Loop;
use App\Models\Tag;
use Illuminate\Http\Request;

class LoopController extends Controller
{
    public function create()
    {
        $tags = Tag::all();
        return view('loops.create', compact('tags'));
    }

    public function index()

    {
        $loops = Loop::all();
        return view('loops.index', compact('loops'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'bpm' => 'nullable|integer',
            'key_signature' => 'nullable|string|max:10',
            'tags' => 'nullable|string',
            'filename' => 'required|file|mimes:mp3,wav',
        ]);

        $filename = $request->file('filename')->store('loops', 'public');

        $loop = Loop::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'bpm' => $request->input('bpm'),
            'key_signature' => $request->input('key_signature'),
            'filename' => $filename,
        ]);

        // Procesar etiquetas (formato Tagify)
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
