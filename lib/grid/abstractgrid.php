<?

namespace Barrelblur\Laptops\Grid;

use Barrelblur\Laptops\Classes\URL;
use Bitrix\Main\Grid\Options;
use Bitrix\Main\UI\PageNavigation;

abstract class AbstractGrid
{
    const SORTING = ['sort' => ['ID' => 'DESC'], 'vars' => ['by' => 'by', 'order' => 'order']];

    private string $entity;
    private array $filterFields;

    private Options $gridOptions;
    private PageNavigation $navigation;
    public URL $url;


    public function __construct(string $entity, array $filterFields)
    {
        $this->entity = $entity;
        $this->filterFields = $filterFields;

        $this->url = URL::getInstance();

        $this->prepare();
    }

    public function prepare(): void
    {
        $this->gridOptions = $this->getGridOptions();

        $this->prepareNavigation();
    }

    public function prepareNavigation(): void
    {
        $gridOptions = $this->getGridOptions();

        $navigationParams = $gridOptions->GetNavParams();

        $navigation = new PageNavigation($this->getGridId());

        $navigation->allowAllRecords(true)
            ->setPageSize($navigationParams['nPageSize'])
            ->initFromUri();

        $navigation->setRecordCount($this->getCountElement($this->filterFields));

        $this->navigation = $navigation;
    }

    public function getGridId(): string
    {
        return 'laptops_' . $this->entity;
    }

    public function getAjaxId(): string
    {
        return \CAjax::getComponentID('bitrix:main.ui.grid', '.default', '');
    }

    public function getGridOptions(): Options
    {
        return new Options($this->getGridId());
    }

    public function getFilterFields(): array
    {
        return $this->filterFields;
    }

    public function getSortFields(): array
    {
        return $this->gridOptions->GetSorting(self::SORTING);
    }

    public function getNavigation(): PageNavigation
    {
        return $this->navigation;
    }

    public function getCount(): int
    {
        return $this->navigation->getRecordCount() ?? 0;
    }

    public function getItems(): array
    {
        $fetchedElements = $this->fetchElements(
            $this->getFilterFields(),
            $this->getSortFields(),
            $this->getNavigation()
        );

        return array_map(fn($item) => ['data' => $item], $fetchedElements);
    }

    public function fetchElements(array $filterFields, array $sortingFields, PageNavigation $navigation): array
    {
        return [];
    }

    public function getColumns(): array
    {
        return [];
    }

    public function getCountElement(array $filterFields): int
    {
        return 0;
    }
}
