<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static Album create(array $array)
 * @method static Album findOrFail(mixed $album_id)
 * @method static orderBy(string $string, string $string1)
 * @method static select(string $string, string $string1, string $string2)
 * @property string $cover_image
 * @property mixed $title
 */
class Album extends Model
{
    use HasFactory;

    const PAGINATION_LENGTH = 20;

    protected $guarded = [];

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }
}
