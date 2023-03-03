<?php

namespace App\Http\Controllers;

use App\Http\Resources\AlbumResource;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Song;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $albums = AlbumResource::collection(Album::all());
        $genres = Genre::all();
        $songs  = Song::with('album')->get();

        return Inertia::render('Dashboard')
            ->with([
                'albums' => $albums,
                'genres' => $genres,
                'songs' => $songs
            ]);
    }
}
