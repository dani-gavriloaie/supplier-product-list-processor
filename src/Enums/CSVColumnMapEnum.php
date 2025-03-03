<?php

namespace DaniGavriloaie\SupplierProductListProcessor\Enums;

enum CSVColumnMapEnum: string
{
    case BRAND_NAME = 'make';
    case MODEL_NAME = 'model';
    case CONDITION_NAME = 'condition';
    case GRADE_NAME = 'grade';
    case GB_SPEC_NAME = 'capacity';
    case COLOUR_NAME = 'colour';
    case NETWORK_NAME = 'network';

    public static function getMappedColumn(string $header): string
    {
        return match ($header) {
            'brand_name' => self::BRAND_NAME->value,
            'model_name' => self::MODEL_NAME->value,
            'condition_name' => self::CONDITION_NAME->value,
            'grade_name' => self::GRADE_NAME->value,
            'gb_spec_name' => self::GB_SPEC_NAME->value,
            'colour_name' => self::COLOUR_NAME->value,
            'network_name' => self::NETWORK_NAME->value,
            default => $header,
        };
    }
}
