<?

namespace Barrelblur\Laptops\Tables;

use Bitrix\Main\ORM\Data\DataManager;

class AbstractDataManager extends DataManager
{
    public static array $resources = [];

    public static function seed(array $resources): void { }
}
