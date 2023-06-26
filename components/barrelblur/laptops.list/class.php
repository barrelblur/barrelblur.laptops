<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Barrelblur\Laptops\Grid\GridFactory;
use Barrelblur\Laptops\Classes\URL;

class LaptopsListComponent extends CBitrixComponent
{
    public function __construct($component = null)
    {
        parent::__construct($component);

        Loader::requireModule('barrelblur.laptops');}

    public function executeComponent()
    {
        $this->configureSingletons();

        $this->getResult();
        $this->includeComponentTemplate();
    }

    public function getResult()
    {
        $grid = GridFactory::createEntity(
            $this->arParams['ENTITY'],
            $this->arParams['FILTER'] ?? []
        );

        $this->arResult['GRID_ID'] = $grid->getGridId();
        $this->arResult['AJAX_ID'] = $grid->getAjaxId();
        $this->arResult['ITEMS'] = $grid->getItems();
        $this->arResult['COUNT'] = $grid->getCount();
        $this->arResult['COLUMNS'] = $grid->getColumns();
        $this->arResult['NAVIGATION'] = $grid->getNavigation();
    }

    public function configureSingletons(): void
    {
        URL::getInstance()->setDefaultSefFolder($this->arParams['SEF_FOLDER']);
    }
}