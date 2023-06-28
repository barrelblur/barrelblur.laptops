<?php

namespace Barrelblur\Laptops\Tables;

use Barrelblur\Laptops\Contracts\Resourceable;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\UniqueValidator;


class ModelTable extends DataManager implements Resourceable
{
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
            new ReferenceField(
                'BRAND',
                'Barrelblur\Laptops\Tables\BrandTable',
                array('=this.BRAND_ID' => 'ref.ID')
            )
        ];
    }

    public static function getResourceFilename(): string
    {
        return 'models.json';
    }
}
