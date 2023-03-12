<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(string[] $array)
 * @method static select(string $string, string $string1)
 * @property string $name
 * @property string $description
 */
class Genre extends Model
{
    use HasFactory;

    const PAGINATION_LENGTH = 10;

    protected $guarded = [];
}
