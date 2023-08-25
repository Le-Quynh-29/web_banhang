<?php

namespace App\Repositories;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ContentRepository
{
    /**
     * Get content of file.
     * @param string $path
     * @return mixed
     */
    public function responseFile($path)
    {
        $pathDecoded = storage_path(base64_decode($path));
        $file = File::get($pathDecoded);
        $mineType = File::mimeType($pathDecoded);
        $response = Response::make($file);
        $response->header('Content-Type', $mineType);
        return $response;
    }

}
