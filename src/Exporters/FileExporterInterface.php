<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Exporters;
use Generator;

interface FileExporterInterface
{
    public function export(string $outputPath, array $data): void;
}