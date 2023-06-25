<?

IncludeModuleLangFile(__FILE__);

use Bitrix\Main\Localization\Loc;

global $APPLICATION;

?>

<form action="<?=$APPLICATION->GetCurPage()?>" name="installation">
    <?=bitrix_sessid_post()?>

    <input type="hidden" name="id" value="barrelblur.laptops">
    <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
    <input type="hidden" name="install" value="Y">
    <input type="hidden" name="step" value="2">

    <label>
        <input type="checkbox" name="refresh_tables" checked>
        <?=Loc::getMessage('REFRESH_TABLES')?>
    </label>

    <div style="margin-top: 20px;">
        <input type="submit" name="install" value="<?=Loc::getMessage("INSTALL_MODULE")?>">
    </div>
</form>
