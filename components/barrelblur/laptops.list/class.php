<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Barrelblur\Laptops\Grid\GridFactory;
use Barrelblur\Laptops\Classes\URL;

class LaptopsListComponent extends CBitrixComponent
{
    /**
     * @param $component
     */
    public function __construct($component = null)
    {
        parent::__construct($component);

        try {
            Loader::requireModule('barrelblur.laptops');
        } catch (Exception $exception) {
            ShowError($exception->getMessage());
        }
    }

    /**
     * @return void
     */
    public function executeComponent(): void
    {
        $this->configureSingletons();

        $this->getResult();
        $this->includeComponentTemplate();
    }

    /**
     * @return void
     * @throws \Bitrix\Main\ObjectNotFoundException
     */
    public function getResult(): void
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

    /**
     * @return void
     */
    public function configureSingletons(): void
    {
        URL::getInstance()->setDefaultSefFolder($this->arParams['SEF_FOLDER']);
    }
}
