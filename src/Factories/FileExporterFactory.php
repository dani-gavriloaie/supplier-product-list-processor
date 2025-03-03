<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Factories;

use DaniGavriloaie\SupplierProductListProcessor\Exporters\CSVExporter;
use DaniGavriloaie\SupplierProductListProcessor\Exporters\FileExporterInterface;
use DaniGavriloaie\SupplierProductListProcessor\Exporters\TSVExporter;
use Exception;

class FileExporterFactory
{
    /** @throws Exception */
    public static function createExporter(string $outputPath): FileExporterInterface
    {
        $fileExtension = pathinfo($outputPath, PATHINFO_EXTENSION);

        return match ($fileExtension) {
            'csv' => new CSVExporter(),
            'tsv' => new TSVExporter(),
            default => throw new Exception("Unsupported file type: $fileExtension"),
        };
    }
}