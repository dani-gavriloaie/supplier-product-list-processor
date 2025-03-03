<?php

use DaniGavriloaie\SupplierProductListProcessor\Parsers\CliArgumentParser;
use DaniGavriloaie\SupplierProductListProcessor\Services\ProductProcessor;

require 'vendor/autoload.php';

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