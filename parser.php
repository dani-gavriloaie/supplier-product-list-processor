<?php

use DaniGavriloaie\SupplierProductListProcessor\Factories\FileExporterFactory;
use DaniGavriloaie\SupplierProductListProcessor\Factories\FileParserFactory;
use DaniGavriloaie\SupplierProductListProcessor\Services\ProductProcessor;

require 'vendor/autoload.php';

$options = getopt('v', ['file:', 'unique-combinations:']);

if (empty($options['file']) || empty($options['unique-combinations'])) {
    die("Usage: php parser.php --file <file> --unique-combinations <output_file>\n");
}

if (isset($options['v'])) {
    $start_time = microtime(true);
}

try {
    $fileParser = FileParserFactory::createParser($options['file']);
    $fileExporter = FileExporterFactory::createExporter($options['unique-combinations']);

    $productProcessor = new ProductProcessor($fileParser, $fileExporter);
    $productProcessor->process($options['file'], $options['unique-combinations']);
} catch (Exception $exception) {
    echo 'An error occurred: ' . $exception->getMessage();
}

if (isset($options['v'])) {
    echo 'Peak Memory Usage: ' . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\n";
    echo 'Execution time: ' . round(microtime(true) - $start_time, 4) . ' seconds';
}