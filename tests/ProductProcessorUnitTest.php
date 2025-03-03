<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Tests;

use DaniGavriloaie\SupplierProductListProcessor\Exceptions\RequiredFieldException;
use DaniGavriloaie\SupplierProductListProcessor\Factories\FileExporterFactory;
use DaniGavriloaie\SupplierProductListProcessor\Factories\FileParserFactory;
use DaniGavriloaie\SupplierProductListProcessor\Services\ProductProcessor;
use Exception;

class ProductProcessorUnitTest
{
    private $productProcessor;
    public function __construct()
    {
        $fileParser = FileParserFactory::createParser('test.csv');
        $fileExporter = FileExporterFactory::createExporter('output.csv');
        $this->productProcessor = new ProductProcessor($fileParser, $fileExporter);
    }

    public function testProcessSuccessful()
    {
        // Arrange
        $headers = ['brand_name', 'model_name', 'condition_name', 'grade_name', 'gb_spec_name', 'colour_name', 'network_name'];
        $data = [
            ['Brand', 'Model', 'Condition', 'Grade', 'Spec', 'Colour', 'Network'],
            ['Brand', 'Model', 'Condition', 'Grade', 'Spec', 'Colour', 'Network']
        ];
        $file = fopen('test.csv', 'w');

        fputcsv($file, $headers);
        foreach($data as $item) {
            fputcsv($file, $item);
        }
        fclose($file);

        // Act
        ob_start();
        $this->productProcessor->process('test.csv', 'output.csv');

        // Assert
        $consoleOutput = ob_get_clean();
        $outputFile = fopen('output.csv', 'r');
        $outputHeaders = fgetcsv($outputFile);
        $outputData = fgetcsv($outputFile);
        fclose($outputFile);

        assertEquals(
            ['make', 'model', 'condition', 'grade', 'capacity', 'colour', 'network', 'count'],
            $outputHeaders,
            'Test Product Processor - Correct headers'
        );

        assertEquals(
            ['Brand', 'Model', 'Condition', 'Grade', 'Spec', 'Colour', 'Network', '2'],
            $outputData,
            'Test Product Processor - Correct output file');

        assertContains(
            '{"make":"Brand","model":"Model","condition":"Condition","grade":"Grade","capacity":"Spec","colour":"Colour","network":"Network"}',
            $consoleOutput,
            'Test Product Processor - Correct console output');



        // Cleanup
        unlink('test.csv');
        unlink('output.csv');
    }

    public function testProcessInvalidProductData()
    {
        // Arrange
        $headers = ['brand_name', 'model_name', 'condition_name', 'grade_name', 'gb_spec_name', 'colour_name', 'network_name'];
        $data = [
            ['Brand', 'Model', 'Condition', 'Grade', 'Spec', 'Colour', 'Network'],
            ['Brand', '', 'Condition', 'Grade', 'Spec', 'Colour', 'Network']
        ];
        $file = fopen('test.csv', 'w');

        fputcsv($file, $headers);
        foreach($data as $item) {
            fputcsv($file, $item);
        }
        fclose($file);

        $ex = false;

        // Act
        try {
            ob_start();
            $this->productProcessor->process('test.csv', 'output.csv');
        } catch (Exception $exception) {
            $ex = $exception;
        } finally {
            ob_get_clean();
        }

        // Assert
        assertTrue($ex instanceof RequiredFieldException, 'Test Product Processor - Invalid required field');

        // Cleanup
        unlink('test.csv');
    }
}