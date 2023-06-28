<?

namespace Barrelblur\Laptops\Grid;

use Barrelblur\Laptops\Contracts\Captionable;
use Barrelblur\Laptops\Tables\BrandTable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI\PageNavigation;

class BrandsGrid extends AbstractGrid implements Captionable
{
    /**
     * @return string
     */
    public static function getCaption(): string
    {
        return Loc::getMessage('BRAND');
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
                'name'    => Loc::getMessage('BRAND'),
                'sort'    => 'NAME',
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

        $brandIterator = BrandTable::getList([
            'offset' => $navigation->getOffset(),
            'limit'  => $navigation->getLimit(),
            'order'  => $sortingFields['sort'],
        ]);

        return array_map(function ($fields) use ($url) {
            $fields['NAME'] = $url->toHref([
                $fields['NAME'],
                $url->getBrandUri($fields['CODE'])
            ]);

            return $fields;
        }, $brandIterator->fetchAll());
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
        $brandIterator = BrandTable::getList([
            'select'      => ['ID'],
            'count_total' => true
        ]);

        return $brandIterator->getCount() ?? 0;
    }
}
