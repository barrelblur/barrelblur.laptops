<?

namespace Barrelblur\Laptops\Grid;

use Barrelblur\Laptops\Contracts\Captionable;
use Barrelblur\Laptops\Tables\ModelTable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI\PageNavigation;

class ModelsGrid extends AbstractGrid implements Captionable
{
    /**
     * @return string
     */
    public static function getCaption(): string
    {
        return Loc::getMessage('MODEL');
    }

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
                'name'    => Loc::getMessage('MODEL'),
                'sort'    => 'NAME',
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

        $modelIterator = ModelTable::getList([
            'select' => [
                'ID',
                'NAME',
                'CODE',
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
                $url->getModelUri($fields['BRAND_CODE'], $fields['CODE'])
            ]);

            $brandUri = $url->toHref([
                $fields['BRAND_NAME'],
                $url->getBrandUri($fields['BRAND_CODE'])
            ]);

            return [
                'ID'    => $fields['ID'],
                'NAME'  => $nameUri,
                'BRAND' => $brandUri,
            ];
        }, $modelIterator->fetchAll());
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
        $modelIterator = ModelTable::getList([
            'select'      => ['ID'],
            'count_total' => true,
            'filter'      => $filterFields
        ]);

        return $modelIterator->getCount() ?? 0;
    }
}
