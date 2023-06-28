<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$arComponentParameters = array(
    'PARAMETERS' => array(
        'SEF_MODE'   => [],
        'SEF_FOLDER' => [
            'PARENT'  => 'BASE',
            'NAME'    => Loc::getMessage('SEF_FOLDER'),
            'TYPE'    => 'STRING',
            'DEFAULT' => '',
        ],
        'ENTITY'     => array(
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
