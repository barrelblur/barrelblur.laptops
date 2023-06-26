<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$APPLICATION->IncludeComponent(
    'barrelblur:laptops.list',
    '',
    [
        'ENTITY'     => $arResult['ENTITY'],
        'FILTER'     => $arResult['FILTER'],
        'SEF_FOLDER' => $arParams['SEF_FOLDER']
    ],
    false
);
