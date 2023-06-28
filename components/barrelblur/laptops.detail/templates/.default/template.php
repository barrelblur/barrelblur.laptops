<?
use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$this->addExternalCss('/bitrix/css/main/bootstrap.css');
?>

<?if(!empty($arResult['RESULT'])):?>
    <section>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-black">
                        <div class="card-body">
                            <h2 class="card-title">
                                <?=$arResult['RESULT']['NAME']?>
                            </h2>

                            <div>
                                <div class="d-flex justify-content-between">
                                    <span>
                                        <?=Loc::getMessage('PRICE')?>:
                                    </span>
                                        <span>
                                        <?=$arResult['RESULT']['PRICE']?>
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>
                                        <?=Loc::getMessage('AT_ANNOUNCED')?>:
                                    </span>
                                    <span>
                                        <?=$arResult['RESULT']['AT_ANNOUNCED']?>
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>
                                        <?=Loc::getMessage('BRAND')?>:
                                    </span>
                                    <span>
                                        <a href="<?=$arResult['RESULT']['BRAND']['LINK']?>">
                                            <?=$arResult['RESULT']['BRAND']['NAME']?>
                                        </a>
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>
                                        <?=Loc::getMessage('MODEL')?>:
                                    </span>
                                    <span>
                                        <a href="<?=$arResult['RESULT']['MODEL']['LINK']?>">
                                            <?=$arResult['RESULT']['MODEL']['NAME']?>
                                        </a>
                                    </span>
                                </div>

                                <hr>

                                <div class="py-1">
                                    <?foreach($arResult['RESULT']['PROPERTIES'] as $propertyName):?>
                                        <span class="badge badge-light">
                                            <?=$propertyName?>
                                        </span>
                                    <?endforeach?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?else:?>
    <?=Loc::getMessage('NOT_FOUND')?>
<?endif?>
