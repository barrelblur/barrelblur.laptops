<?php

namespace Barrelblur\Laptops\Tables;

use Barrelblur\Laptops\Contracts\Seedable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\UniqueValidator;


class BrandTable extends AbstractDataManager implements Seedable
{
    public static array $resources = ['brands'];

    public static function getTableName(): string
    {
        return 'barrelblur_laptops_brands';
    }

    public static function getMap(): array
    {
        return [
            new IntegerField('ID', ['primary' => true, 'autocomplete' => true]),
            new StringField('CODE', [
                'required'   => true,
                'validation' => function () {
                    return array(
                        new UniqueValidator(Loc::getMessage('DUPLICATED_CODE')),
                    );
                }
            ]),
            new StringField('NAME', ['required' => true]),
        ];
    }

    public static function seed(array $resources): void
    {
        if (!empty($resources['brands'])) {
            self::addMulti($resources['brands']);
        }
    }
}
