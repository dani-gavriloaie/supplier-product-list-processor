<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Parsers;

class CliArgumentParser
{
    private array $args;
    private array $parsedArgs = [];

    public function __construct(array $args) {
        $this->args = $args;
        $this->parseArguments();
    }

    private function parseArguments(): void {
        for ($i = 1; $i < count($this->args); $i++) {
            $arg = $this->args[$i];

            if (str_starts_with($arg, '--')) {
                $parts = explode('=', ltrim($arg, '--'), 2);
                $key = $parts[0];

                // Handle flags with values (e.g., --file example_1.csv)
                if (count($parts) === 2) {
                    $this->parsedArgs[$key] = $parts[1];
                } elseif (isset($this->args[$i + 1]) && !str_starts_with($this->args[$i + 1], '--')) {
                    $this->parsedArgs[$key] = $this->args[$i + 1];
                    $i++; // Skip next argument since it's part of the current flag
                } else {
                    // Handle flags without values
                    $this->parsedArgs[$key] = true;
                }
            }
        }
    }

    public function get(string $key, $default = null) {
        return $this->parsedArgs[$key] ?? $default;
    }

    public function getAll(): array {
        return $this->parsedArgs;
    }
}