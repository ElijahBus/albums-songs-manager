<?php

namespace App\Http\Controllers;

use App\Http\Resources\AlbumResource;
use App\Models\Album;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $albums = AlbumResource::collection(Album::all());

        return Inertia::render('Dashboard')
            ->with(['albums' => $albums]);
    }
}
