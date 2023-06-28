<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$APPLICATION->IncludeComponent(
    'barrelblur:entities',
    '',
    [
        'BASE_URL' => $arParams['SEF_FOLDER'],
        'ENTITY'   => $arResult['ENTITY'],
    ]
);

$APPLICATION->IncludeComponent(
    'bitrix:main.ui.grid',
    '',
    [
        'TOTAL_ROWS_COUNT'          => $arResult['COUNT'],
        'GRID_ID'                   => $arResult['GRID_ID'],
        'COLUMNS'                   => $arResult['COLUMNS'],
        'ROWS'                      => $arResult['ITEMS'],
        'NAV_OBJECT'                => $arResult['NAVIGATION'],
        'AJAX_ID'                   => $arResult['AJAX_ID'],
        'AJAX_MODE'                 => 'Y',
        'AJAX_OPTION_HISTORY'       => 'N',
        'AJAX_OPTION_JUMP'          => 'N',
        'PAGE_SIZES'                => [
            ['NAME' => "5", 'VALUE' => '5'],
            ['NAME' => '10', 'VALUE' => '10'],
            ['NAME' => '20', 'VALUE' => '20'],
            ['NAME' => '50', 'VALUE' => '50'],
            ['NAME' => '100', 'VALUE' => '100']
        ],
        'SHOW_CHECK_ALL_CHECKBOXES' => true,
        'SHOW_ROW_ACTIONS_MENU'     => true,
        'SHOW_GRID_SETTINGS_MENU'   => true,
        'SHOW_NAVIGATION_PANEL'     => true,
        'SHOW_PAGINATION'           => true,
        'SHOW_SELECTED_COUNTER'     => false,
        'SHOW_TOTAL_COUNTER'        => true,
        'SHOW_PAGESIZE'             => true,
        'SHOW_ROW_CHECKBOXES'       => false,
        'SHOW_ACTION_PANEL'         => false,
        'ALLOW_COLUMNS_SORT'        => true,
        'ALLOW_COLUMNS_RESIZE'      => true,
        'ALLOW_HORIZONTAL_SCROLL'   => true,
        'ALLOW_SORT'                => true,
        'ALLOW_PIN_HEADER'          => true
    ]
);
