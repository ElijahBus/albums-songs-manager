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
     * Show the form for creating a new song.
     */
    public function create(): Response
    {
        $genres = Genre::select('id', 'name')->paginate(Genre::PAGINATION_LENGTH);

        $albums = AlbumResource::collection(
            Album::select('id', 'title', 'cover_image')
                ->orderBy('id', 'desc')
                ->paginate(Album::PAGINATION_LENGTH)
        );

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
     * Show the form for editing the song.
     */
    public function edit(Song $song): Response
    {
        $genres = Genre::select('id', 'name')->paginate(Genre::PAGINATION_LENGTH);

        $albums = AlbumResource::collection(
            Album::select('id', 'title', 'cover_image')
                ->orderBy('id', 'desc')
                ->paginate(Album::PAGINATION_LENGTH)
        );

        return Inertia::render('EditSong')->with([
            'song' => $song,
            'genres' => $genres,
            'albums' => $albums
        ]);
    }

    /**
     * Update the specified song in storage.
     */
    public function update(UpdateSongRequest $request, Song $song): RedirectResponse
    {
        $validatedRequest = $request->validated();

        $song->update([
            'title' => $validatedRequest['title'],
            'length' => $validatedRequest['length'],
            'genre' => $validatedRequest['genre'],
            'album_id' => $validatedRequest['album_id'],
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified song from storage.
     */
    public function destroy(Song $song): RedirectResponse
    {
        $song->delete();

        return redirect()->route('dashboard');
    }
}
