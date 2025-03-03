<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Exporters;

use DaniGavriloaie\SupplierProductListProcessor\Enums\CSVColumnMapEnum;

class CSVExporter implements FileExporterInterface
{
    protected string $separator = ",";
    protected string $enclosure = '"';
    protected string $escape = '\\';

    public function export(string $outputPath, array $data) : void {
        $file = fopen($outputPath, 'w');

        $headers = array_column(CSVColumnMapEnum::cases(), 'value');
        $headers[] = 'count';
        fputcsv($file, $headers, $this->separator, $this->enclosure, $this->escape);

        foreach ($data as $item) {
            fputcsv(
                $file,
                array_merge($item['product']->toArray(), [$item['count']]),
                $this->separator,
                $this->enclosure,
                $this->escape
            );
        }

        fclose($file);
    }
}