<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait HasFile
{
    /**
     * Upload image
     * @return string|null
     */
    protected function uploadFile($file, $folder)
    {
        if ($file !== null && is_file($file)) {
            $file_extension = $file->getClientOriginalExtension();
            $file_name = date('Ymd').'_'.time().'.'.$file_extension;
            Storage::disk('public')->put($folder . $file_name, file_get_contents($file));
            $folder = str_replace('\\', '/', $folder);
            return "storage/$folder" . $file_name;
        }
    }

    /**
     * Delete image
     * @param string $file_name
     */
    protected function deleteFile(string $file_name): void
    {
        if ($file_name !== null && File::exists($file_name)) {
            File::delete($file_name);
        }
    }

    /**
     * Save new image and delete old image
     * @param $image
     * @param $previous_image
     * @param $delete_image
     * @param $file_path
     */
    protected function updateImage($image, $previous_image, $delete_image , $file_path)
    {
        if ($image !== null && $previous_image === null) {
            if ($delete_image !== null) {
                $this->deleteFile($delete_image);
            }
            return $this->uploadFile($image, $file_path);
        } elseif ($delete_image !== null && $previous_image === null) {
            $this->deleteFile($delete_image);
            return null;
        }
        return $previous_image;
    }
}
