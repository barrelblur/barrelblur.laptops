<?php

namespace Barrelblur\Laptops\Tables;

use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;


class PropertiesTable extends AbstractDataManager
{
    public static string $resource = 'properties.json';

    public static function getTableName(): string
    {
        return 'barrelblur_laptops_properties';
    }

    public static function getMap(): array
    {
        return [
            new IntegerField('ID', ['primary' => true, 'autocomplete' => true]),
            new StringField('NAME', ['required' => true]),
        ];
    }
}
