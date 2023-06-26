<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$arComponentParameters = array(
    'PARAMETERS' => array(
        'SEF_FOLDER' => array(
            'PARENT'  => 'BASE',
            'NAME'    => Loc::getMessage('SEF_URL'),
            'TYPE'    => 'STRING',
            'DEFAULT' => '',
        ),
    ),
);
