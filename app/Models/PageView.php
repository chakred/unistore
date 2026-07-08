<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'views',
    ];

    /**
     * Increment the site-wide page view counter.
     */
    public static function track(): void
    {
        static::firstOrCreate(['id' => 1], ['views' => 0])->increment('views');
    }

    /**
     * Get the current site-wide page view count.
     */
    public static function current(): int
    {
        return static::firstOrCreate(['id' => 1], ['views' => 0])->views;
    }
}
