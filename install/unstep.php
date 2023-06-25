<?

IncludeModuleLangFile(__FILE__);

use Bitrix\Main\Localization\Loc;

global $APPLICATION;

?>

<form action="<?=$APPLICATION->GetCurPage()?>" name="uninstallation">
    <?=bitrix_sessid_post()?>

    <input type="hidden" name="id" value="barrelblur.laptops">
    <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
    <input type="hidden" name="uninstall" value="Y">
    <input type="hidden" name="step" value="2">

    <label>
        <input type="checkbox" id="delete_tables" name="delete_tables" checked>
        <?=Loc::getMessage('DELETE_TABLES')?>
    </label>

    <div style="margin-top: 20px;">
        <input type="submit" name="uninstall" value="<?=Loc::getMessage("UNINSTALL_MODULE")?>">
    </div>
</form>
