<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Barrelblur\Laptops\Classes\URL;

class LaptopsComponent extends CBitrixComponent
{
    public string $template;

    public function __construct($component = null)
    {
        parent::__construct($component);

        Loader::requireModule('barrelblur.laptops');
    }

    public function executeComponent(): void
    {
        $this->getResult();
        $this->includeComponentTemplate($this->template);
    }

    private function getResult(): void
    {
        [$this->template, $variables] = URL::parsePath($this->arParams['SEF_FOLDER']);

        $this->arResult['VARIABLES'] = $variables;
        $this->arResult['ENTITY'] = $this->template;
    }
}
