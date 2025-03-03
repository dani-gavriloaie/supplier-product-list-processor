<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Factories;

use DaniGavriloaie\SupplierProductListProcessor\Parsers\CSVParser;
use DaniGavriloaie\SupplierProductListProcessor\Parsers\FileParserInterface;
use DaniGavriloaie\SupplierProductListProcessor\Parsers\TSVParser;
use Exception;

class FileParserFactory
{
    /** @throws Exception */
    public static function createParser(string $filePath): FileParserInterface
    {
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        return match ($fileExtension) {
            'csv' => new CSVParser(),
            'tsv' => new TSVParser(),
            default => throw new Exception("Unsupported file type: $fileExtension"),
        };
    }
}