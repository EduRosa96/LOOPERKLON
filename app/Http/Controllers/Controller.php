<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function index()
{
    $loops = \App\Models\Loop::with('tags')->latest()->get();
    return view('loops.index', compact('loops'));
}
}
