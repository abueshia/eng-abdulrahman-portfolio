<?php

/**
 * HandleUploadFile Trait
 *
 * Provides helper methods on Eloquent models implementing Spatie HasMedia
 * to store, replace, and clear single or multiple media collection files.
 */

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HandleUploadFile
{
    /**
     * Replace the single file in the model's media collection if an uploaded file is provided.
     */
    public function updateFile(?UploadedFile $image, string $prefix = ''): void
    {
        if ($image instanceof UploadedFile) {
            $collection = $this->getTable().$prefix;
            $this->clearMediaCollection($collection);
            $this->addMedia($image)->toMediaCollection($collection);
        }
    }

    /**
     * Replace all files in the model's media collection with the provided array of uploaded files.
     *
     * @param  array<int|string, UploadedFile>|null  $images
     */
    public function updateFiles(?array $images, string $prefix = ''): void
    {
        if (! empty($images)) {
            $collection = $this->getTable().$prefix;
            $this->clearMediaCollection($collection);
            foreach ($images as $image) {
                if ($image instanceof UploadedFile) {
                    $this->addMedia($image)->toMediaCollection($collection);
                }
            }
        }
    }

    /**
     * Store a single uploaded file into the model's media collection.
     */
    public function storeFile(?UploadedFile $image, string $prefix = ''): void
    {
        if ($image instanceof UploadedFile) {
            $this->addMedia($image)->toMediaCollection($this->getTable().$prefix);
        }
    }

    /**
     * Append multiple uploaded files into the model's media collection.
     *
     * @param  array<int|string, UploadedFile>  $images
     */
    public function storeFiles(array $images, string $prefix = ''): void
    {
        if (! empty($images)) {
            $collection = $this->getTable().$prefix;
            foreach ($images as $image) {
                if ($image instanceof UploadedFile) {
                    $this->addMedia($image)->toMediaCollection($collection);
                }
            }
        }
    }

    /**
     * Clear all files in the model's media collection.
     */
    public function deleteFiles(string $prefix = ''): void
    {
        $this->clearMediaCollection($this->getTable().$prefix);
    }
}
