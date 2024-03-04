<?php

namespace App\Imports;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

interface FileImportInterface
{
    public function importFile(UploadedFile $file);
}
