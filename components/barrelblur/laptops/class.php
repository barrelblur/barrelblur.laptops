<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Barrelblur\Laptops\Classes\URL;
use Barrelblur\Laptops\Grid\GridFactory;

class LaptopsComponent extends CBitrixComponent
{
    public string $template;
    private URL $url;

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

        $this->url = URL::getInstance();
    }

    /**
     * @return void
     */
    public function executeComponent(): void
    {
        if ($_GET['entity'] && GridFactory::has($_GET['entity'])) {
            $this->template = $_GET['entity'];
            $this->arResult['ENTITY'] = $this->template;
        } else {
            $this->getResult();
        }

        $this->includeComponentTemplate($this->template);
    }

    /**
     * @return void
     */
    public function getResult(): void
    {
        [$this->template, $variables] = $this->url->parsePath($this->arParams['SEF_FOLDER'] ?? '');

        $this->arResult['VARIABLES'] = $variables;
        $this->arResult['ENTITY'] = $this->template;
        $this->arResult['FILTER'] = $this->getFilter($this->template, $variables);
    }

    /**
     * @param string $entity
     * @param array  $variables
     *
     * @return array
     */
    public function getFilter(string $entity, array $variables): array
    {
        $filterFields = [];

        if($entity == 'models') $filterFields['=BRAND.CODE'] = $variables['BRAND_CODE'];
        if($entity == 'laptops') $filterFields['=MODEL.CODE'] = $variables['MODEL_CODE'];
        if($entity == 'detail') $filterFields['ELEMENT_CODE'] = $variables['LAPTOP_CODE'];

        return $filterFields;
    }
}
