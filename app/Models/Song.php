<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string title the title of the song
 * @property string genre the genre of the song
 * @property int album_id the parent album of the song
 * @property int length the length of the song stored in seconds
 */
class Song extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
