<?

namespace Barrelblur\Laptops\Grid;

use Barrelblur\Laptops\Tables\LaptopTable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI\PageNavigation;

class LaptopsGrid extends AbstractGrid
{
    /**
     * @return array[]
     */
    public function getColumns(): array
    {
        return [
            [
                'id'      => 'ID',
                'name'    => 'ID',
                'sort'    => 'ID',
                'default' => true
            ],
            [
                'id'      => 'NAME',
                'name'    => Loc::getMessage('LAPTOP'),
                'sort'    => 'NAME',
                'default' => true
            ],
            [
                'id'      => 'PRICE',
                'name'    => Loc::getMessage('PRICE'),
                'sort'    => 'PRICE',
                'default' => true
            ],
            [
                'id'      => 'AT_ANNOUNCED',
                'name'    => Loc::getMessage('AT_ANNOUNCED'),
                'sort'    => 'AT_ANNOUNCED',
                'default' => true
            ],
            [
                'id'      => 'MODEL',
                'name'    => Loc::getMessage('MODEL'),
                'sort'    => 'MODEL.NAME',
                'default' => true
            ],
            [
                'id'      => 'BRAND',
                'name'    => Loc::getMessage('BRAND'),
                'sort'    => 'BRAND.NAME',
                'default' => true
            ],
        ];
    }

    /**
     * @param array          $filterFields
     * @param array          $sortingFields
     * @param PageNavigation $navigation
     *
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function fetchElements(array $filterFields, array $sortingFields, PageNavigation $navigation): array
    {
        $url = $this->url;

        $laptopIterator = LaptopTable::getList([
            'select' => [
                'ID',
                'CODE',
                'NAME',
                'PRICE',
                'AT_ANNOUNCED',
                'MODEL_NAME' => 'MODEL.NAME',
                'MODEL_CODE' => 'MODEL.CODE',
                'BRAND_NAME' => 'BRAND.NAME',
                'BRAND_CODE' => 'BRAND.CODE'
            ],
            'offset' => $navigation->getOffset(),
            'limit'  => $navigation->getLimit(),
            'order'  => $sortingFields['sort'],
            'filter' => $filterFields,
        ]);

        return array_map(function ($fields) use ($url) {
            $nameUri = $url->toHref([
                $fields['NAME'],
                $url->getLaptopUri($fields['CODE'])
            ]);

            $modelUri = $url->toHref([
                $fields['MODEL_NAME'],
                $url->getModelUri($fields['BRAND_CODE'], $fields['MODEL_CODE'])
            ]);

            $brandUri = $url->toHref([
                $fields['BRAND_NAME'],
                $url->getBrandUri($fields['BRAND_CODE'])
            ]);

            return [
                'ID'           => $fields['ID'],
                'NAME'         => $nameUri,
                'PRICE'        => number_format($fields['PRICE'], 0, '', ' ') . ' ₽',
                'AT_ANNOUNCED' => $fields['AT_ANNOUNCED'],
                'MODEL'        => $modelUri,
                'BRAND'        => $brandUri,
            ];
        }, $laptopIterator->fetchAll());
    }

    /**
     * @param array $filterFields
     *
     * @return int
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function getCountElement(array $filterFields): int
    {
        $laptopIterator = LaptopTable::getList([
            'select'      => ['ID'],
            'count_total' => true,
            'filter'      => $filterFields
        ]);

        return $laptopIterator->getCount() ?? 0;
    }
}
