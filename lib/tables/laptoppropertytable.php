<?php

namespace Barrelblur\Laptops\Tables;

use Barrelblur\Laptops\Contracts\Resourceable;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;


class LaptopPropertyTable extends DataManager implements Resourceable
{
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

    public static function getResourceFilename(): string
    {
        return 'laptop_properties.json';
    }
}
