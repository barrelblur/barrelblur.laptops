<?php

namespace Barrelblur\Laptops\Tables;

use Barrelblur\Laptops\Contracts\Seedable;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;


class LaptopPropertyTable extends AbstractDataManager implements Seedable
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

    public static function seed(array $resource): void
    {
        if (!empty($resource)) {
            self::addMulti($resource);
        }
    }
}
