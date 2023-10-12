<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;

trait HasImage
{

    protected string $disk = 'public';
    protected string $baseDir = 'uploads';

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * Stores an Image to the defined directory in a polymorphic way
     * @param ?string $name leave null for Original name
     * @param string $dir directory name after baseDirectory
     */
    public function storeImage(UploadedFile $image, string $dir = '', ?string $name = null): Image
    {
        $name = $name ?? $image->getClientOriginalName();
        $name = str($name)->slug() . uniqid();
        $path = $image->storeAs($this->baseDir . "/" . $dir, $name, $this->disk);
        $image = Image::create([
            'imageable_id' => $this->id,
            'imageable_type' => get_class($this)
        ]);
        return $image;
    }
}
