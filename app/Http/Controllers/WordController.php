<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $words = \App\Models\Word::where('user_id', Auth::id())->get();
        return Inertia::render('words', [
            'words' => $words,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'words' => 'required|string',
        ]);

        $words = preg_split('/\r\n|\r|\n/', trim($request->words));
        $userId = Auth::id();

        $data = collect($words)
            ->map(fn($word) => trim($word))
            ->filter(fn($word) => !empty($word)) // remove blank lines
            ->map(fn($word) => [
                'word' => $word,
                'user_id' => $userId,
                'created_at' => now(),
                'last_used_at' => null, // explicitly null
            ])
            ->toArray();

        Word::query()->insert($data);

        return redirect()->back()->with('success', 'Words added successfully!');       //
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $words)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $words)
    {
        //
    }
}
