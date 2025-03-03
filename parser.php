<?php

use DaniGavriloaie\SupplierProductListProcessor\Parsers\CliArgumentParser;
use DaniGavriloaie\SupplierProductListProcessor\Services\ProductProcessor;

require 'vendor/autoload.php';

$options = getopt('', ['file:', 'unique-combinations:']);

if (empty($options['file']) || empty($options['unique-combinations'])) {
    die("Usage: php parser.php --file <file> --unique-combinations <output_file>\n");
}

$cliArgumentsParser = new CliArgumentParser($argv);
$args = $cliArgumentsParser->getAll();

if (!$args['file']) {
    throw new Exception('\'file\' argument is missing');
}

if (!$args['unique-combinations']) {
    throw new Exception('\'unique-combinations\' argument is missing');
}

$productProcessor = new ProductProcessor();
$productProcessor->process();