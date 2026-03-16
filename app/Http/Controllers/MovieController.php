<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $movies = $request->user()->movies;

        return response()->json([
            'movies' => $movies,
        ], 200);
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
        $validated = $request->validate([
            'titre' => 'required|string',
        ]);

        $movie = $request->user()->movies()->create([
            'titre' => $validated['titre'],
        ]);

        return response()->json([
            'message' => 'film cree avec succes',
            'movie' => $movie,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'message' => 'film introuvable',
            ], 404);
        }

        $this->authorize('view',$movie);

        return response()->json([
            'movie' => $movie,
        ], 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'message' => 'film introuvable'
            ], 404);
        }

        $this->authorize('update',$movie);

        $request->validate([
            'titre' => 'required|string|max:255',
        ]);

        $movie->update([
            'titre' => $request->titre,
        ]);

        return response()->json([
            'message' => 'film modifie avec succes',
            'movie' => $movie
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'message' => 'film introuvable'
            ], 404);
        }
        
        $this->authorize('delete',$movie);
        
        $movie->delete();

        return response()->json([
            'message' => 'film supprime avec succes'
        ], 200);
    }
}
