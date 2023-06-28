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
        'ELEMENT_CODE' => array(
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('ELEMENT_CODE'),
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
    ),
);
