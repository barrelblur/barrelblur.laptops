<?php

namespace Barrelblur\Laptops\Tables;

use Barrelblur\Laptops\Contracts\Seedable;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;


class PropertiesTable extends AbstractDataManager implements Seedable
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

    public static function seed(array $resource): void
    {
        if (!empty($resource)) {
            self::addMulti($resource);
        }
    }
}
