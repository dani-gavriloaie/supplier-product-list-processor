<?php

use DaniGavriloaie\SupplierProductListProcessor\Services\ProductProcessor;

require 'vendor/autoload.php';

$options = getopt('', ['file:', 'unique-combinations:']);

if (empty($options['file']) || empty($options['unique-combinations'])) {
    die("Usage: php parser.php --file <file> --unique-combinations <output_file>\n");
}

try {
    $productProcessor = new ProductProcessor();
    $productProcessor->process($options['file'], $options['unique-combinations']);
} catch (Exception $exception) {
    echo 'An error occurred: ' . $exception->getMessage();
}