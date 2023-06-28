<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$this->addExternalCss('/bitrix/css/main/bootstrap.css');
?>

<?if($arResult['LINKS']):?>
    <ul class="nav nav-tabs">
        <?foreach($arResult['LINKS'] as $linkFields):?>
            <li class="nav-item">
                <a class="nav-link <?if($linkFields['ACTIVE']):?>active<?endif?>" href="<?=$linkFields['LINK']?>">
                    <?=$linkFields['NAME']?>
                </a>
            </li>
        <?endforeach?>
    </ul>
<?endif?>
