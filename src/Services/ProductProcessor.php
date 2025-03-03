<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Services;

use DaniGavriloaie\SupplierProductListProcessor\Exceptions\RequiredFieldException;
use DaniGavriloaie\SupplierProductListProcessor\Factories\FileExporterFactory;
use DaniGavriloaie\SupplierProductListProcessor\Factories\FileParserFactory;
use DaniGavriloaie\SupplierProductListProcessor\Models\Product;

class ProductProcessor
{
    /** @throws RequiredFieldException|\Exception */
    public function process(string $filePath, string $outputPath): void
    {
        $fileParser = FileParserFactory::createParser($filePath);

        /** @var Product $product */
        $uniqueProducts = [];
        foreach ($fileParser->parse($filePath) as $product) {
            echo json_encode($product) . "\r\n";

            $hash = md5($product->toString());

            if (isset($uniqueProducts[$hash])) {
                $uniqueProducts[$hash]['count'] += 1;
            } else {
                $uniqueProducts[$hash] = [
                    'product' => $product,
                    'count' => 1
                ];
            }
        }

        $fileExporter = FileExporterFactory::createExporter($outputPath);
        $fileExporter->export($outputPath, $uniqueProducts);
    }
}
