<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$arComponentDescription = array(
    'NAME'        => Loc::getMessage('NAME'),
    'DESCRIPTION' => Loc::getMessage('DESCRIPTION'),
    'COMPLEX'     => 'Y',
    'SORT'        => 10,
    'PATH'        => array(
        'ID'   => 'barrelblur',
        'NAME' => Loc::getMessage('PATH'),
        'SORT' => 10,
    )
);