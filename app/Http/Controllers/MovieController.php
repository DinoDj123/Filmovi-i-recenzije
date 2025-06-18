<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::latest()->paginate(4);
        return view('movies.index',['movies'=>$movies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'review'=>'required|string',
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'rating' => 'nullable|numeric|min:0|max:10',
            'published_at' => 'required|date',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ]);
        $validated['created_at'] = now();
        $validated['updated_at'] = now();
        
        if ($request->hasFile('picture')) {
        $file = $request->file('picture');
        $filename = str_replace(' ', '', $validated['title']) . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('posters', $filename, 'public');
        $validated['picture'] = $path;
    }
        $validated['user_id'] = auth()->id();    
    

        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view('movies.show', ['movie' => $movie]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        if (auth()->user()->isAdmin() || $movie->user_id === auth()->id()) {
            return view('movies.edit', compact('movie'));
        }
        return redirect()->route('movies.index')->withErrors(['error'=>'Unauthorized action.']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        if (!auth()->user()->isAdmin() && $movie->user_id !== auth()->id()) {
            return redirect()->route('movies.index')->withErrors(['error'=> 'Unauthorized action.']);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'review' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'rating' => 'nullable|numeric|min:0|max:10',
            'published_at' => 'required|date',
        ]);

        if ($request->hasFile('picture')) {
            if ($movie->picture) {
                Storage::disk('public')->delete($movie->picture);
            }
            $path = $request->file('picture')->store('posters', 'public');
            $validated['picture'] = $path;
        }

        $movie->update($validated);
        return redirect()->route('movies.show', $movie)->with('success', 'Movie updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        if (auth()->user()->isAdmin() || $movie->user_id === auth()->id()) {
            if ($movie->picture) {
                Storage::disk('public')->delete($movie->picture);
            }
            $movie->delete();
            return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
        }
        return redirect()->route('movies.index')->withErrors(['error', 'Unauthorized action.']);
    }
}
