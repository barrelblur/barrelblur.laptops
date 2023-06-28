<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Barrelblur\Laptops\Contracts\Captionable;
use Barrelblur\Laptops\Grid\GridFactory;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if(!Loader::includeModule('barrelblur.laptops')) return false;

$entityValues = [];
foreach (GridFactory::getAll() as $entityCode => $entity) {
    if (in_array(Captionable::class, class_implements($entity))) {
        $entityValues[$entityCode] = $entity::getCaption();
    }
}

$arComponentParameters = [
    'PARAMETERS' => [
        'ENTITY'   => [
            'PARENT'  => 'BASE',
            'NAME'    => Loc::getMessage('ENTITY'),
            'TYPE'    => 'LIST',
            'VALUES'  => $entityValues,
            'DEFAULT' => '',
        ],
        'BASE_URL' => [
            'PARENT'  => 'BASE',
            'NAME'    => Loc::getMessage('BASE_URL'),
            'TYPE'    => 'STRING',
            'DEFAULT' => '',
        ],
    ],
];
