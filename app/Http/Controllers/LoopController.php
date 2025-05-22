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

        $loop = new Loop([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'bpm' => $request->input('bpm'),
            'key_signature' => $request->input('key_signature'),
            'filename' => $filename,
        ]);

        $loop->user_id = auth()->id(); // Aquí guardamos el usuario que sube el loop
        $loop->save();

        // Procesar etiquetas (formato Tagify)
        if ($request->filled('tags')) {
            $tagsArray = [];

            $tagsJson = $request->input('tags');
            $decoded = json_decode($tagsJson);

            if (is_array($decoded)) {
                $tagsArray = collect($decoded)->pluck('value')->toArray();
            }

            $tagIds = collect($tagsArray)
                ->filter(fn($tag) => trim($tag) !== '')
                ->unique()
                ->map(fn($tagName) => Tag::firstOrCreate(['name' => trim($tagName)])->id);

            $loop->tags()->sync($tagIds);
        }

        return redirect()->route('loops.index')->with('success', 'Loop subido correctamente');
    }
}
