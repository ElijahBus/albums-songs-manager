<?php

namespace App\Services;


use Illuminate\Http\UploadedFile;

class ImageProcessingService
{
    /**
     * @param  mixed        $image the image file to save
     * @param  string       $path  the directory path
     * @return string|bool         the full path to the file on the system
     */
    public function saveFromHttpRequest(mixed $image, string $path, $disk = 'public'): string|bool
    {
        // This is more likely to be a developer passing a wrong type,
        // less likely to come from the user since the validator will have prevented that.
        // We explicitly abort and show the trace instead of return a custom exception.
        if (! $image instanceof UploadedFile)
            abort(400, 'Attempted to store a file of wrong type');

        return $image->store($path, $disk);
    }

}
