<?php

namespace App\Services;

use Dflydev\DotAccessData\Data;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class SupplierService
{
    private $fields = [];

    /**
     * @return SupplierService
     */
    public static function getInstance(): SupplierService
    {
        return new self();
    }

    public function supplierCatalogStore(UploadedFile $file, int $id)
    {
        $data = [];
        if ($id == 1)
            $data = $this->getCSVDate($file, '|');
        elseif ($id == 2)
            $data = $this->getCSVDate($file, ';');

        if (count($data) > 0) {

            $tableName = $this->createTable($id, $data[0]);
            $this->populateTable($tableName, $data);

        }
    }

    private function getCSVDate(UploadedFile $file, string $separator = ';'): array
    {
        $result = [];
        $filePath = $file->store('upload');

        $fullFilePath = Storage::path($filePath);

        if (($handle = fopen($fullFilePath, "r")) !== FALSE) {
            for ($r = 1; ($row = fgetcsv($handle, 1000, $separator)) !== FALSE; $r++) {

                $cols = [];
                $colsCount = count($row) - 1;
                for ($c = 0; $c < $colsCount; $c++) {
                    if ($r === 1)
                        $cols[] = str_replace(' ', '_', strtolower($row[$c]));
                    else {
                        $cols[$result[0][$c]] = utf8_encode($row[$c]);
                    }
                }
                $result[] = $cols;
            }
            fclose($handle);
        }

        return $result;
    }

    private function createTable(int $supplier_id, array $fields): string
    {
        $tableName    = 'supplier_' . $supplier_id;
        $this->fields = $fields;

        if (Schema::hasTable($tableName))
            return $tableName;

        Schema::create($tableName, function (Blueprint $table) {
            $table->increments('id');

            foreach ($this->fields as $field) {
                $table->text($field);
            }
            $table->timestamps();
        });

        return $tableName;
    }

    private function populateTable(string $tableName, array $data): bool
    {
        array_shift($data);
        try {
//            $data = collect($data)->chunk(100)->toArray();
            foreach (array_chunk($data,100) as $chunk_data) {
//                dd($chunk_data);
                    DB::table($tableName)->insert($chunk_data);
            }

            return true;

        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
