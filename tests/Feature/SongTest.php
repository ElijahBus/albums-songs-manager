<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\Song;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SongTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->album = Album::factory()->create();

    }

    public function test_user_can_create_song()
    {
        $this->actingAs($this->user)->post(route('songs.store'), [
            'title' => 'One and only',
            'length' => 60,
            'genre' => 'Jazz',
            'album_id' => $this->album->id
        ]);

        $this->assertDatabaseHas('songs', ['title' => 'One and only']);
    }

    public function test_user_can_update_song()
    {
        $song = Song::factory()->create([
            'title' => 'My 2023 Song',
            'length' => 60,
            'genre' => 'Jazz',
            'album_id' => $this->album->id
        ]);

        $this->assertDatabaseHas('songs',['title' => 'My 2023 Song']);

        $this->actingAs($this->user)->put(route('songs.update', $song->id), [
            'title' => 'My 2023 Song Updated',
            'length' => 60,
            'genre' => 'Jazz',
            'album_id' => $this->album->id
        ]);

        $this->assertDatabaseHas('songs',['title' => 'My 2023 Song Updated']);
    }

    public function test_user_can_delete_song()
    {
        Schema::disableForeignKeyConstraints();

        $song = Song::factory()->create();
        $this->assertDatabaseHas('songs', ['id' => $song->id]);

        $this->actingAs($this->user)->delete(route('songs.destroy', $song->id));
        $this->assertDatabaseMissing('songs', ['id' => $song->id]);

        Schema::enableForeignKeyConstraints();
    }
}
