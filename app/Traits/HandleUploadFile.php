<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HandleUploadFile
{

    /**
     * Undocumented function.
     *
     * @param UploadedFile|null $image
     * @return void
     */
    public function updateFile($image, $prefix =''): void
    {
        if (isset($image)) {
            $this->clearMediaCollection($this->getTable().$prefix);
            $this->addMedia($image)->toMediaCollection($this->getTable().$prefix);
        }
    }

    public function updateFiles($images): void
    {
        if (isset($images)) {
            $this->clearMediaCollection($this->getTable());
            foreach ($images as $key => $image) {
                $this->addMedia($image)->toMediaCollection($this->getTable());
            }
        }
    }

    public function storeFile(?UploadedFile $image , $prefix =''): void
    {
        if (isset($image)) {
            $this->addMedia($image)->toMediaCollection($this->getTable().$prefix);
        }
    }

    public function storeFiles(array $images): void
    {
        if (! empty($images)) {
            foreach ($images as $key => $image) {
                $this->addMedia($image)->toMediaCollection($this->getTable());
            }
        }
    }

    public function deleteFiles(): void
    {
        $this->clearMediaCollection($this->getTable());
    }

}
