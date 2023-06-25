<?

namespace Barrelblur\Laptops\Tables;

use Bitrix\Main\ORM\Data\DataManager;

class AbstractDataManager extends DataManager
{
    public ?string $resources = null;
}
