<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasImages {

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}