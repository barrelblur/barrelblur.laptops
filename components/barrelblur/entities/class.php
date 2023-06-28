<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Loader;
use Barrelblur\Laptops\Grid\GridFactory;
use Barrelblur\Laptops\Contracts\Captionable;

class LaptopsEntitiesComponent extends CBitrixComponent
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
        $this->getResult();
        $this->includeComponentTemplate();
    }

    public function getResult(): void
    {
        $linksList = [];

        foreach(GridFactory::getAll() as $entityCode => $entity)
        {
            if(in_array(Captionable::class, class_implements($entity)))
            {
                $linksList[] = [
                    'NAME' => $entity::getCaption(),
                    'CODE' => $entityCode,
                    'LINK' => $this->getEntityLink($entityCode),
                    'ACTIVE' => $this->isActiveLink($entityCode)
                ];
            }
        }

        $this->arResult['LINKS'] = $linksList;
    }

    private function getEntityLink(string $entityCode): string
    {
        return $this->arParams['BASE_URL'] . '?entity=' . $entityCode;
    }

    private function isActiveLink(string $entityCode): bool
    {
        return $entityCode == $_GET['entity'];
    }
}
