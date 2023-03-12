<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSongRequest;
use App\Http\Requests\UpdateSongRequest;
use App\Http\Resources\AlbumResource;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Song;
use Inertia\Inertia;
use Inertia\Response;

class GenreController extends Controller
{
    /**
     * Display the specified genre.
     */
    public function show(Genre $genre): Response
    {
        $albums = AlbumResource::collection(
            Album::select('id', 'title', 'cover_image')
                ->orderBy('id', 'desc')
                ->paginate(Album::PAGINATION_LENGTH)
        );

        $genres = Genre::select('id', 'name')->paginate(Genre::PAGINATION_LENGTH);

        $songs  = Song::with('album')
            ->orderBy('id', 'desc')
            ->where('genre', $genre->name)
            ->paginate(Song::PAGINATION_LENGTH);

        return Inertia::render('Dashboard')
            ->with([
                'albums' => $albums,
                'genres' => $genres,
                'songs' => $songs,
                'filtered_genre' => $genre->name
            ]);
    }
}
