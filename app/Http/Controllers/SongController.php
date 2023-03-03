<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSongRequest;
use App\Http\Requests\UpdateSongRequest;
use App\Http\Resources\AlbumResource;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Song;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new song.
     */
    public function create(): Response
    {
        $genres = Genre::all();
        $albums = AlbumResource::collection(Album::all());

        return Inertia::render('CreateSong')->with([
            'genres' => $genres,
            'albums' => $albums
        ]);
    }

    /**
     * Store a newly created song in storage.
     */
    public function store(StoreSongRequest $request): RedirectResponse
    {
        $validatedRequest = $request->validated();

        $album = Album::findOrFail($validatedRequest['album_id']);

        $album->songs()->create([
            'title' => $validatedRequest['title'],
            'length' => $validatedRequest['length'],
            'genre' => $validatedRequest['genre']
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSongRequest $request, Song $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        //
    }
}
