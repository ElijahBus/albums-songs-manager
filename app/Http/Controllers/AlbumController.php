<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Album;
use App\Services\ImageProcessingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AlbumController extends Controller
{
    private ImageProcessingService $imageProcessingService;

    /**
     * @param ImageProcessingService $imageProcessingService
     */
    public function __construct(ImageProcessingService $imageProcessingService)
    {
        $this->imageProcessingService = $imageProcessingService;
    }


    /**
     * Show the form for creating a new album.
     */
    public function create(): Response
    {
        return Inertia::render('CreateAlbum');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlbumRequest $request): RedirectResponse
    {
        $validatedRequest = $request->validated();

        $coverImagePath = $this->imageProcessingService->saveFromHttpRequest(
            $request->file('cover_image'),
            'cover'
        );

        Album::create([
            'title' => $validatedRequest['title'],
            'description' => $validatedRequest['description'],
            'release_date' => $validatedRequest['release_date'],
            'cover_image' => $coverImagePath
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified album.
     */
    public function edit(Album $album): Response
    {
        return Inertia::render('EditAlbum')->with(['album' => $album]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumRequest $request, Album $album): RedirectResponse
    {
        $validatedRequest = $request->validated();

        if (! $request->hasFile('cover_image')) {
            $album->update([
                'title' => $validatedRequest['title'],
                'description' => $validatedRequest['description'],
                'release_date' => $validatedRequest['release_date'],
                'cover_image' => $album->cover_image
            ]);
        } else {
            $this->imageProcessingService->deleteFile($album->cover_image);

            $newCoverImagePath = $this->imageProcessingService->saveFromHttpRequest(
                $request->file('cover_image'),
                'cover'
            );

            $album->update([
                'title' => $validatedRequest['title'],
                'description' => $validatedRequest['description'],
                'release_date' => $validatedRequest['release_date'],
                'cover_image' => $newCoverImagePath
            ]);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album): RedirectResponse
    {
        $album->delete();

        return redirect()->route('dashboard');
    }
}
