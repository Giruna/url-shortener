<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $code
 * @property string $long_url
 */
class ShortUrl extends Model
{
    protected $fillable = ['code', 'long_url'];
}
