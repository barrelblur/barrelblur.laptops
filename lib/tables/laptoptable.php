<?php

namespace Barrelblur\Laptops\Tables;

use Barrelblur\Laptops\Contracts\Seedable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Event;
use Bitrix\Main\ORM\EventResult;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\UniqueValidator;
use Bitrix\Main\Type\Date;


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
            new DateField('AT_ANNOUNCED', ['required' => true]),
            new IntegerField('PRICE', ['required' => true]),
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

    public static function seed(array $resource): void
    {
        if (!empty($resource)) {
            self::addMulti($resource);
        }
    }
}
