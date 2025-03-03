<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Models;

use DaniGavriloaie\SupplierProductListProcessor\Exceptions\RequiredFieldException;

class Product
{
    public string $make;
    public string $model;
    public ?string $condition;
    public ?string $grade;
    public ?string $capacity;
    public ?string $colour;
    public ?string $network;

    public function __construct(
        string $make,
        string $model,
        ?string $condition = null,
        ?string $grade = null,
        ?string $capacity = null,
        ?string $colour = null,
        ?string $network = null,
    ) {
        $this->make = $make;
        $this->model = $model;
        $this->condition = $condition;
        $this->grade = $grade;
        $this->capacity = $capacity;
        $this->colour = $colour;
        $this->network = $network;
    }

    public function toString(): string {
        return json_encode(get_object_vars($this), JSON_PRETTY_PRINT);
    }

    public function toArray(): array {
        return get_object_vars($this);
    }

    /** @throws RequiredFieldException */
    public static function fromArray(array $data): Product {
        if (empty($data['make']) || empty($data['model'])) {
            throw new RequiredFieldException("Required fields 'make' and 'model' must be present.");
        }

        return new self(
            make: $data['make'],
            model: $data['model'],
            condition: $data['condition'],
            grade: $data['grade'],
            capacity: $data['capacity'],
            colour: $data['colour'],
            network: $data['network']
        );
    }
}