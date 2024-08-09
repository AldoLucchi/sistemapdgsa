<?php

namespace App\Services;

class AuxiliarService
{
    public function getImageFile($file)
    {
        $image = '';
        if ($file) {
            $exploded = explode('.', $file);
            $fileExtension = end($exploded);
            if (in_array($fileExtension, ['gif', 'jpeg', 'jpg', 'png'])) {
                $image =   $file;
            } elseif (in_array($fileExtension, ['pdf'])) {
                $image = 'pdf.png';
            } elseif (in_array($fileExtension, ['doc', 'docx'])) {
                $image = 'word.png';
            } elseif (in_array($fileExtension, ['xls', 'xlsx'])) {
                $image = 'excel.png';
            } else {
                $image = 'not-image.png';
            }
        }

        return $image;
    }
}
