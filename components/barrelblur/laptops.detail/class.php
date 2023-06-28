<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Barrelblur\Laptops\Classes\URL;
use Barrelblur\Laptops\Tables\LaptopTable;
use Bitrix\Main\Loader;
use Bitrix\Main\ORM\Objectify\Collection;
use Bitrix\Main\ORM\Objectify\EntityObject;

class LaptopsDetailComponent extends CBitrixComponent
{
    private URL $url;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->url = URL::getInstance();

        try {
            Loader::requireModule('barrelblur.laptops');
        } catch (Exception $exception) {
            ShowError($exception->getMessage());
        }
    }

    public function executeComponent(): void
    {
        $this->configureSingletons();

        $this->getResult();
        $this->includeComponentTemplate();
    }

    private function getResult(): void
    {
        $resultFields = [];

        if ($elementCode = $this->arParams['ELEMENT_CODE']) {
            $laptopIterator = LaptopTable::getList([
                'filter' => [
                    'CODE' => $elementCode
                ],
                'select' => [
                    'ID',
                    'CODE',
                    'NAME',
                    'PRICE',
                    'AT_ANNOUNCED',
                    'PROPERTIES',
                    'BRAND',
                    'MODEL',
                ]
            ]);

            /** @var Collection $collection */
            $laptopObject = $laptopIterator->fetchObject();

            if($laptopObject)
            {
                $resultFields = $this->getScalarFields($laptopObject);

                $brandObject = $laptopObject->getBrand();
                $modelObject = $laptopObject->getModel();
                $propertiesObject = $laptopObject->getProperties();

                $resultFields['BRAND'] = $this->getBrandFields($brandObject);
                $resultFields['MODEL'] = $this->getModelFields($modelObject, $brandObject);
                $resultFields['PROPERTIES'] = $this->getPropertiesList($propertiesObject);
            }
        }

        $this->arResult['RESULT'] = $resultFields;
    }

    public function getScalarFields(EntityObject $entityObject)
    {
        return [
            'ID'           => $entityObject->getId(),
            'CODE'         => $entityObject->getCode(),
            'NAME'         => $entityObject->getName(),
            'PRICE'        => $this->formatPrice($entityObject->getPrice()),
            'AT_ANNOUNCED' => $entityObject->getAtAnnounced()->toString()
        ];
    }

    public function formatPrice(int $value): string
    {
        return number_format($value, 0, '', ' ') . ' ₽';
    }

    public function getLinkFields(EntityObject $entityObject, callable $linkFormatter): array
    {
        return [
            'NAME' => $entityObject->getName(),
            'CODE' => $entityObject->getCode(),
            'LINK' => $linkFormatter($this->url)
        ];
    }

    public function configureSingletons(): void
    {
        URL::getInstance()->setDefaultSefFolder($this->arParams['SEF_FOLDER']);
    }

    public function getBrandFields(EntityObject $brandObject): array
    {
        return $this->getLinkFields(
            $brandObject,
            function (URL $url) use ($brandObject) {
                return $url->getBrandUri($brandObject->getCode());
            }
        );
    }

    public function getModelFields(EntityObject $modelObject, EntityObject $brandObject): array
    {
        return $this->getLinkFields(
            $modelObject,
            function (URL $url) use ($brandObject, $modelObject) {
                return $url->getModelUri(
                    $brandObject->getCode(),
                    $modelObject->getCode()
                );
            }
        );
    }

    public function getPropertiesList(ArrayAccess $propertyObject): array
    {
        $propertiesList = [];

        /* @var EntityObject[] $propertyObject */
        foreach ($propertyObject as $propertyItem) {
            $propertiesList[$propertyItem->getId()] = $propertyItem->getName();
        }

        return $propertiesList;
    }
}
