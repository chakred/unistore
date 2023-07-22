<?php

namespace Modules\Good\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected static function newFactory()
    {
        return \Modules\Good\Database\factories\CountryFactory::new();
    }
}
