<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['value'];

    function user()
    {
        return $this->belongsTo(User::class);
    }
    function notes()
    {
        return $this->morphedByMany(Note::class, 'taggable');
    }
}
