<?php

namespace Barrelblur\Laptops\Tables;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;


class PropertiesTable extends DataManager
{
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

    public static function getResourceFilename(): string
    {
        return 'properties.json';
    }
}
