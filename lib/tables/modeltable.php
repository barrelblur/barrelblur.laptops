<?php

namespace Barrelblur\Laptops\Tables;

use Barrelblur\Laptops\Contracts\Seedable;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;


class ModelTable extends AbstractDataManager implements Seedable
{
    public static array $resources = ['models'];

    public static function getTableName(): string
    {
        return 'barrelblur_laptops_models';
    }

    public static function getMap(): array
    {
        return [
            new IntegerField('ID', ['primary' => true, 'autocomplete' => true]),
            new StringField('NAME', ['required' => true]),
        ];
    }

    public static function seed(array $resources): void { }
}
