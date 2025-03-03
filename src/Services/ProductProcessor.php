<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Services;

use DaniGavriloaie\SupplierProductListProcessor\Exceptions\RequiredFieldException;
use DaniGavriloaie\SupplierProductListProcessor\Factories\FileParserFactory;
use DaniGavriloaie\SupplierProductListProcessor\Models\Product;

class ProductProcessor
{
    /** @throws RequiredFieldException|\Exception */
    public function process(string $filePath, string $outputPath): void
    {
        $fileParser = FileParserFactory::createParser($filePath);
        $fileParser->parse($filePath);

        /** @var Product $product */
        $uniqueProducts = [];
        foreach ($fileParser->parse($filePath) as $product) {
            $hash = md5($product->toString());

            if (in_array($hash, $uniqueProducts)) {
                $uniqueProducts[$hash]['count'] += 1;
            } else {
                $uniqueProducts[$hash] = [
                    'product' => $product,
                    'count' => 1
                ];
            }
        }

        foreach ($uniqueProducts as $productData) {
            $product = $productData['product'];
            echo $product->toString() . ' count: ' . $productData['count'];
        }

        echo memory_get_peak_usage();
    }
}
