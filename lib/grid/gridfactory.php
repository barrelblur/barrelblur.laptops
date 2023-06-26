<?

namespace Barrelblur\Laptops\Grid;

use Bitrix\Main\ObjectNotFoundException;

class GridFactory
{
    public const ENTITIES = [
        'brands'  => BrandsGrid::class,
        'models'  => ModelsGrid::class,
        'laptops' => LaptopsGrid::class,
    ];

    public static function createEntity(string $entity, string $sefFolder, array $filterFields): AbstractGrid
    {
        if (!isset(self::ENTITIES[$entity])) {
            throw new ObjectNotFoundException('Entity "' . $entity . '" not found');
        }

        $class = self::ENTITIES[$entity];

        return new $class($entity, $sefFolder, $filterFields);
    }
}
