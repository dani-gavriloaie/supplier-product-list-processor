<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Parsers;

interface FileParserInterface
{
    public function parse(string $filePath): \Generator;
}