<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$arComponentDescription = array(
    'NAME'        => GetMessage('NAME'),
    'DESCRIPTION' => GetMessage('DESCRIPTION'),
    'SORT'        => 20,
    'PATH'        => array(
        'ID'   => 'barrelblur',
        'NAME' => GetMessage('PATH'),
        'SORT' => 10,
    )
);
