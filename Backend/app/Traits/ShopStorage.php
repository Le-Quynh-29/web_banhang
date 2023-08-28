<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ShopStorage {
    /**
     * Save file to storage
     * @param mixed $requestFile
     * @param string $folder
     */
    public function uploadFile($requestFile, $folder)
    {
        $this->createFolder($folder);
        $encodeFilename = time() . '_' . sha1($requestFile->getClientOriginalName()) . '.' . $requestFile->getClientOriginalExtension();
        $filename = base64_encode($encodeFilename);
        try {
            Storage::disk('local')->putFileAs($folder, $requestFile, $filename);
        } catch (\RuntimeException $e) {
            dd($e->getMessage());
        }
        return $folder . '/' . $filename;
    }

    /**
     * Delete file storage
     * @param string $fileName
     */
    public function deleteFile($fileName)
    {
        // Check if file exists in storage
        if (!Storage::disk('local')->exists($fileName)) {
            return;
        }

        // Process to delete file
        try {
            if ($fileName) {
                Storage::delete($fileName);
            }
            return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Create a article folder
     * @param string $module
     */
    private function createFolder($module)
    {
        try {
            Storage::disk('local')->makeDirectory($module);
        } catch (\RuntimeException $e) {
            dd($e->getMessage());
        }
    }
}
