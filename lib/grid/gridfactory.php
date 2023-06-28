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

    /**
     * @param string $entity
     * @param array  $filterFields
     *
     * @return AbstractGrid
     * @throws ObjectNotFoundException
     */
    public static function createEntity(string $entity, array $filterFields): AbstractGrid
    {
        if (!isset(self::ENTITIES[$entity])) {
            throw new ObjectNotFoundException('Entity "' . $entity . '" not found');
        }

        $class = self::ENTITIES[$entity];

        return new $class($entity, $filterFields);
    }
}
