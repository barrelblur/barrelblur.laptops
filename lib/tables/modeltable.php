<?php

namespace Barrelblur\Laptops\Tables;

use Barrelblur\Laptops\Contracts\Seedable;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\UniqueValidator;


class ModelTable extends AbstractDataManager implements Seedable
{
    public static string $resource = 'models.json';

    public static function getTableName(): string
    {
        return 'barrelblur_laptops_models';
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
            new IntegerField('BRAND_ID', ['required' => true]),
        ];
    }

    public static function seed(array $resource): void
    {
        if (!empty($resource)) {
            self::addMulti($resource);
        }
    }
}
