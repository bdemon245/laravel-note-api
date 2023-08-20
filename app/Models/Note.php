<?php

namespace App\Models;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'content' => Encrypted::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
