<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Inertia\Inertia;
use App\Models\Album;
use App\Models\Genre;
use Inertia\Response;
use App\Http\Resources\AlbumResource;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $albums = AlbumResource::collection(
            Album::select('id', 'title', 'cover_image')
                ->orderBy('id', 'desc')
                ->paginate(Album::PAGINATION_LENGTH)
        );

        $genres = Genre::select('id', 'name')->paginate(Genre::PAGINATION_LENGTH);

        $songs  = Song::with('album')
            ->orderBy('id', 'desc')
            ->paginate(Song::PAGINATION_LENGTH);

        return Inertia::render('Dashboard')
            ->with([
                'albums' => $albums,
                'genres' => $genres,
                'songs' => $songs
            ]);
    }
}
