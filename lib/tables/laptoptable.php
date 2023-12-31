<?php

namespace Barrelblur\Laptops\Tables;

use Barrelblur\Laptops\Contracts\Resourceable;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Event;
use Bitrix\Main\ORM\EventResult;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\ManyToMany;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\UniqueValidator;
use Bitrix\Main\Type\Date;


class LaptopTable extends DataManager implements Resourceable
{
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
            new DateField('AT_ANNOUNCED', ['required' => true]),
            new IntegerField('PRICE', ['required' => true]),
            new ReferenceField(
                'BRAND',
                'Barrelblur\Laptops\Tables\BrandTable',
                array('=this.BRAND_ID' => 'ref.ID')
            ),
            new ReferenceField(
                'MODEL',
                'Barrelblur\Laptops\Tables\ModelTable',
                array('=this.MODEL_ID' => 'ref.ID')
            ),
            (new ManyToMany('PROPERTIES', PropertiesTable::class))
                ->configureTableName('barrelblur_laptops_laptop_properties')
                ->configureLocalPrimary('ID', 'LAPTOP_ID')
                ->configureLocalReference('NOTEBOOK')
                ->configureRemotePrimary('ID', 'PROPERTY_ID')
                ->configureRemoteReference('PROPERTY')
        ];
    }

    public static function onBeforeAdd(Event $event): EventResult
    {
        return self::handleAtAnnouncedField($event);
    }

    public static function onBeforeUpdate(Event $event): EventResult
    {
        return self::handleAtAnnouncedField($event);
    }

    public static function handleAtAnnouncedField(Event $event): EventResult
    {
        $fields = $event->getParameter('fields');

        $result = new EventResult();
        $result->modifyFields(['AT_ANNOUNCED' => new Date($fields['AT_ANNOUNCED'], 'Y-m-d')]);

        return $result;
    }

    public static function getResourceFilename(): string
    {
        return 'laptops.json';
    }
}
