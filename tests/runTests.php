<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/Utils/Assertions.php';

use DaniGavriloaie\SupplierProductListProcessor\Tests\ProductProcessorUnitTest;

$productProcessorUnitTest = new ProductProcessorUnitTest();
$productProcessorUnitTest->testProcessSuccessful();
$productProcessorUnitTest->testProcessInvalidProductData();