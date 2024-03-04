<?php

namespace App\Imports\Csv;

use App\Contracts\Repositories\EmployeeRepositoryContract;
use App\Imports\FileImportInterface;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;

class ImportEmployee implements FileImportInterface
{
    private string $pathToFile;

    private string $path;

    public function __construct(private EmployeeRepositoryContract $employeeRepositoryContract)
    {
        $this->path = storage_path('app/import/employees');

        if(!file_exists($this->path)){
            mkdir($this->path, 0777, true);
        }
    }

    public function importFile(UploadedFile $file): bool
    {
        try{
            $name = microtime() . 'import-employee.' . $file->extension();
            $fullPath = $file->move($this->path, $name)->getPathname();
            $this->setPathToFile($fullPath);
            $this->importEmployeeInDB();

            return true;
        }catch (\Exception $e){
            throw ValidationException::withMessages([
                'import_file' => __('File is not valid'),
            ]);
        }
    }

    private function setPathToFile($path): void
    {
        $this->pathToFile = $path;
    }


    private function importEmployeeInDB(): void
    {
        if(file_exists($this->pathToFile)){
            $data = file($this->pathToFile);
            $this->saveEmployeeInDB($data);
        }
    }

    private function saveEmployeeInDB(array $data): void
    {
        $employeeData = [];

        for ($i = 1; $i < count($data); $i++){
            $row = str_getcsv($data[$i]);
            $employeeData[] = [
                'first_name' => $row[0],
                'last_name' => $row[1],
                'middle_name' => $row[2] ?? '',
            ];
        }

        $this->employeeRepositoryContract->insert($employeeData);
    }

}
