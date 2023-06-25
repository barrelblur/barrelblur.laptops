<?php

namespace Barrelblur\Laptops\Tables;

use Bitrix\Main\ORM\Fields\IntegerField;


class LaptopPropertyTable extends AbstractDataManager
{
    public static string $resource = 'laptop_properties.json';

    public static function getTableName(): string
    {
        return 'barrelblur_laptops_laptop_properties';
    }

    public static function getMap(): array
    {
        return [
            new IntegerField('ID', ['primary' => true, 'autocomplete' => true]),
            new IntegerField('LAPTOP_ID', ['required' => true]),
            new IntegerField('PROPERTY_ID', ['required' => true]),
        ];
    }
}
