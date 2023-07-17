<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['value'];

    function users()
    {
        return $this->morphedByMany(User::class, 'taggable');
    }
    function notes()
    {
        return $this->morphedByMany(Note::class, 'taggable');
    }
}
