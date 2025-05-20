<?php

namespace App\Http\Controllers;

use App\Models\Loop;
use Illuminate\Http\Request;
use App\Models\Tag;




class LoopController extends Controller
{
    public function index()
    {
        $loops = Loop::latest()->get(); // obtiene todos los loops
        return view('index', compact('loops'));
    }

    public function create()
    {
        $tags = Tag::all(); // Esto recupera todas las etiquetas existentes
        return view('loops.create', compact('tags'));
    }


   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'bpm' => 'nullable|integer',
        'key_signature' => 'nullable|string|max:10',
        'tags' => 'array',
        'tags.*' => 'string|max:50',
        // Añade otras validaciones según tu formulario
    ]);

    $loop = Loop::create($request->only(['title', 'description', 'bpm', 'key_signature']));

    // Procesar etiquetas
    if ($request->has('tags')) {
        $tagIds = [];
        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $loop->tags()->sync($tagIds);
    }

    return redirect()->route('loops.index')->with('success', 'Loop creado con éxito');
}

}
