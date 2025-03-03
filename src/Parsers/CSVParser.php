<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Parsers;

use DaniGavriloaie\SupplierProductListProcessor\Exceptions\RequiredFieldException;
use DaniGavriloaie\SupplierProductListProcessor\Models\Product;
use Generator;

class CSVParser implements FileParserInterface
{
    static array $columnMap = [
        'brand_name' => 'make',
        'model_name' => 'model',
        'condition_name' => 'condition',
        'grade_name' => 'grade',
        'gb_spec_name' => 'capacity',
        'colour_name' => 'colour',
        'network_name' => 'network'

    ];

    protected string $separator = ",";

    /**
     * @throws RequiredFieldException
     * @return Generator<Product> A generator that yields Product objects.
     */
    public function parse(string $filePath): Generator
    {
        $file = fopen($filePath, 'r');
        $headers = fgetcsv($file, 0, $this->separator);

        $mappedHeaders = array_map(function($header) {
            return self::$columnMap[$header] ?? $header;
        }, $headers);

        while ($row = fgetcsv($file, 0, $this->separator)) {
            $data = array_combine($mappedHeaders, $row);
            yield Product::fromArray($data);
        }

        fclose($file);
    }
}