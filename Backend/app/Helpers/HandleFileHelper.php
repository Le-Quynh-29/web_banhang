<?php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
    if (!function_exists('uploadFileHepler')) {
        function uploadFileHepler($requestFile, $folder, $disk = 'public', $filename = null)
        {
            try {
                $filename = !is_null($filename) ? $filename : Str::random(10);
                return $requestFile->storeAs(
                    $folder,
                    $filename . "." . $requestFile->getClientOriginalExtension(),
                    $disk
                );
            } catch (\Exception $e) {
                report($e);
                return $e->getMessage();
            }
        }
    }
    if (!function_exists('deleteFileHepler')) {
         function deleteFileHepler($fileName)
        {
            try {
                if ($fileName) {
                    Storage::delete(str_replace('storage', 'public', $fileName));
                }
                return true;
            } catch (\Exception $e) {
                report($e);
                return $e->getMessage();
            }
        }
    }
