<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Services;

use DaniGavriloaie\SupplierProductListProcessor\Exporters\FileExporterInterface;
use DaniGavriloaie\SupplierProductListProcessor\Models\Product;
use DaniGavriloaie\SupplierProductListProcessor\Parsers\FileParserInterface;

class ProductProcessor
{
    public function __construct(
        private readonly FileParserInterface $fileParser,
        private readonly FileExporterInterface $fileExporter
    ) {}

    /** @throws \Exception */
    public function process(string $filePath, string $outputPath): void
    {
        /** @var Product $product */
        $uniqueProducts = [];
        foreach ($this->fileParser->parse($filePath) as $product) {
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

        $this->fileExporter->export($outputPath, $uniqueProducts);
    }
}
