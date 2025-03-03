<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Models;

class Product
{
    public string $make;
    public string $model;
    public ?string $colour;
    public ?string $capacity;
    public ?string $network;
    public ?string $grade;
    public ?string $condition;

    public function __construct(
        string $make,
        string $model,
        ?string $colour = null,
        ?string $capacity = null,
        ?string $network = null,
        ?string $grade = null,
        ?string $condition = null
    ) {
        $this->make = $make;
        $this->model = $model;
        $this->colour = $colour;
        $this->capacity = $capacity;
        $this->network = $network;
        $this->grade = $grade;
        $this->condition = $condition;
    }

    public function toString(): string {
        return json_encode(get_object_vars($this), JSON_PRETTY_PRINT);
    }
}