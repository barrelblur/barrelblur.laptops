<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

class LaptopsComponent extends CBitrixComponent
{
    public function __construct($component = null)
    {
        parent::__construct($component);

        Loader::requireModule('barrelblur.laptops');
    }


    public function executeComponent()
    {
        $this->getResult();
        $this->includeComponentTemplate();
    }

    private function getResult()
    {
    }
}
