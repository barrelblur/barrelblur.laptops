<?

namespace Barrelblur\Laptops\Grid;

use Bitrix\Main\ObjectNotFoundException;

class GridFactory
{
    private const ENTITIES = [
        'brands'  => BrandsGrid::class,
        'models'  => ModelsGrid::class,
        'laptops' => LaptopsGrid::class,
    ];

    /**
     * @param string $entityCode
     * @param array  $filterFields
     *
     * @return AbstractGrid
     * @throws ObjectNotFoundException
     */
    public static function createEntity(string $entityCode, array $filterFields): AbstractGrid
    {
        if (!isset(self::ENTITIES[$entityCode])) {
            throw new ObjectNotFoundException('Entity "' . $entityCode . '" not found');
        }

        $class = self::ENTITIES[$entityCode];

        return new $class($entityCode, $filterFields);
    }

    /**
     * @return AbstractGrid[]
     */
    public static function getAll(): array
    {
        return self::ENTITIES;
    }

    /**
     * @param string $entityCode
     *
     * @return bool
     */
    public static function has(string $entityCode): bool
    {
        return isset(self::ENTITIES[$entityCode]);
    }
}
