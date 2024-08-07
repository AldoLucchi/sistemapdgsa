<?php

namespace App\Services;

class AuxiliarService
{
    public function getImageFile($file)
    {
        $image = 'not-image.png';
        if ($file) {
            $exploded = explode('.', $file);
            $fileExtension = end($exploded);
            if (in_array($fileExtension, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG])) {
                $image =   $file;
            } elseif (in_array($fileExtension, ['pdf'])) {
                $image = 'pdf.png';
            } elseif (in_array($fileExtension, ['doc', 'docx'])) {
                $image = 'word.png';
            } elseif (in_array($fileExtension, ['xls', 'xlsx'])) {
                $image = 'excel.png';
            }
        }

        return $image;
    }
}