<?php

namespace App\Core\File;

class FileService
{
    /**
     * Store new file to storage
     *
     * @param [type] $image
     * @param string $path
     * @return String
     */
    public static function storeFile($image, string $path = ''): string
    {
        $domain = request()->getSchemeAndHttpHost();
        $result = $image->store($path);

        return $domain . '/' . str_replace(
            'public/',
            'storage/', $result
            );
    }
}
