<?php

namespace Barrelblur\Laptops\Tables;

use Barrelblur\Laptops\Contracts\Seedable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\UniqueValidator;


class LaptopTable extends AbstractDataManager implements Seedable
{
    public static string $resource = 'laptops.json';

    public static function getTableName(): string
    {
        return 'barrelblur_laptops_laptops';
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
            new IntegerField('MODEL_ID', ['required' => true]),
            new IntegerField('BRAND_ID', ['required' => true]),
            new DatetimeField('AT_ANNOUNCED', ['required' => true]),
            new IntegerField('PRICE', ['required' => true]),
        ];
    }

    public static function seed(array $resource): void
    {
        if (!empty($resource)) {
            self::addMulti($resource);
        }
    }
}
