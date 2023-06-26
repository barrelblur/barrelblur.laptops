<?

namespace Barrelblur\Laptops\Grid;

use Barrelblur\Laptops\Tables\BrandTable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI\PageNavigation;

class BrandsGrid extends AbstractGrid
{
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

    public function fetchElements(array $filterFields, array $sortingFields, PageNavigation $navigation): array
    {
        $url = $this->url;

        $brandIterator = BrandTable::getList([
            'offset' => $navigation->getOffset(),
            'limit'  => $navigation->getLimit(),
            'order'  => $sortingFields['sort'],
        ]);

        return array_map(function ($brandFields) use ($url) {
            $brandFields['NAME'] = $url->toHref([
                $brandFields['NAME'],
                $url->getBrandUri($brandFields['CODE'])
            ]);

            return $brandFields;
        }, $brandIterator->fetchAll());
    }

    public function getCountElement(array $filterFields): int
    {
        $brandIterator = BrandTable::getList([
            'select'      => ['ID'],
            'count_total' => true
        ]);

        return $brandIterator->getCount() ?? 0;
    }
}
