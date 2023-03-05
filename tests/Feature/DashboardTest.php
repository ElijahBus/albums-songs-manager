<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\Song;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }


    public function test_user_can_view_albums_songs_and_genres_on_the_dashboard()
    {
        Schema::disableForeignKeyConstraints();

        Storage::fake('public');

        $album = Album::factory()->create();

        $song = Song::factory()->create();

        $songGenres = ['Jazz', 'Pop', 'Classic'];

        $this->artisan('db:seed --class=GenreSeeder');

        $response = $this->actingAs($this->user)->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertSee($album->title);
        $response->assertSee($song->title);
        $response->assertSee(array_rand($songGenres));

        Schema::enableForeignKeyConstraints();

    }
}
