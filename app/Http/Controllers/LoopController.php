<?php

namespace App\Http\Controllers;

use App\Models\Loop;
use Illuminate\Http\Request;

class LoopController extends Controller
{
    public function index()
    {
        $loops = Loop::latest()->get(); // obtiene todos los loops
        return view('index', compact('loops'));
    }

    public function create()
    {
        return view('loops.create'); // formulario
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'bpm' => 'nullable|integer',
            'key_signature' => 'nullable|string|max:10',
            'file' => 'required|file|mimes:mp3,wav|max:10000',
        ]);

        // Guardar archivo
        $filename = $request->file('file')->store('loops', 'public');

        // Guardar en la base de datos
        Loop::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'bpm' => $validated['bpm'],
            'key_signature' => $validated['key_signature'],
            'filename' => $filename,
        ]);

        return redirect()->route('loops.index')->with('success', 'Loop subido correctamente');
    }
}
