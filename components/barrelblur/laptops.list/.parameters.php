<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$arComponentParameters = array(
    'PARAMETERS' => array(
        'ENTITY' => array(
            'PARENT'  => 'BASE',
            'NAME'    => GetMessage('ENTITY'),
            'TYPE'    => 'LIST',
            'VALUES'  => [
                'brands'  => Loc::getMessage('BRANDS'),
                'models'  => Loc::getMessage('MODELS'),
                'laptops' => Loc::getMessage('LAPTOPS'),
            ],
            'DEFAULT' => 'brands',
        ),
    ),
);
