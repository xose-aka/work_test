<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SupplierService
{
    /**
     * @return SupplierService
     */
    public static function getInstance(): SupplierService
    {
        return new self();
    }

    public function supplierCSV(UploadedFile $file): array
    {
        $result = [];
        $filePath = $file->store('upload');

        $fullFilePath = Storage::path($filePath);

        if (($handle = fopen($fullFilePath, "r")) !== FALSE) {
            for ($r = 1; ($row = fgetcsv($handle, 1000, "|")) !== FALSE; $r++) {

                if ($r === 1)
                    continue;

                $cols = [];
                $colsCount = count($row) - 1;
                for ($c = 0; $c < $colsCount; $c++) {
                    $cols[] = $row[$c];
                }

                $result[] = $cols;
            }
            fclose($handle);
        }

        return $result;
    }


}
