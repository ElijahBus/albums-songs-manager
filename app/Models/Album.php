<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static Album create(array $array)
 * @method static Album findOrFail(mixed $album_id)
 */
class Album extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }
}
