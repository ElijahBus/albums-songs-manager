<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AlbumTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_user_can_create_album()
    {
        Storage::fake('public');

        $this->actingAs($this->user)->post(route('albums.store'), [
            'title' => 'Album one',
            'description' => 'Album description one',
            'release_date' => now(),
            'cover_image' => UploadedFile::fake()->image('cover_image.jpg')
        ]);


        $this->assertTrue(Album::all()->count() == 1);
    }

    public function test_user_can_update_album()
    {
        $album = Album::factory()->create([
            'title' => 'New album',
            'description' => 'Album description one',
            'release_date' => now(),
            'cover_image' => 'img/src/path-to-image-file/'
        ]);

        $this->assertDatabaseHas('albums',['title' => 'New album']);

        $this->actingAs($this->user)->put(route('albums.update', $album->id), [
            'title' => 'New album updated',
            'description' => 'Album description updated',
            'release_date' => now(),
            'cover_image' => 'img/src/path-to-image-file/'
        ]);

        $this->assertDatabaseHas('albums',['title' => 'New album updated']);
    }

    public function test_user_can_delete_album()
    {
        $album = Album::factory()->create();
        $this->assertTrue(Album::all()->count() == 1);

        $this->actingAs($this->user)->delete(route('albums.destroy', $album->id));
        $this->assertTrue(Album::all()->count() == 0);
    }
}
