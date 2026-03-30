<?php

namespace App\Listeners;

use App\Events\UploadImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ResizeImage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UploadImage $event): void
    {
        $upload = Storage::get($event->image_path);

        $extension = pathinfo($event->image_path, PATHINFO_EXTENSION);

        $image = Image::read($upload)
                        ->scale(width: 1200)
                        ->encodeByExtension($extension, quality: 70);
        Storage::put(
            $event->image_path,
            $image
        );
    }
}
