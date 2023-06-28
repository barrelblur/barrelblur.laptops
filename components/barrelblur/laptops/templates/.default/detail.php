<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$APPLICATION->IncludeComponent(
    'barrelblur:laptops.detail',
    '',
    [
        'ELEMENT_CODE' => $arResult['FILTER']['ELEMENT_CODE'],
        'SEF_FOLDER'   => $arParams['SEF_FOLDER']
    ],
    false
);
