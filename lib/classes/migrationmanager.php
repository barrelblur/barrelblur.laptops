<?

namespace Barrelblur\Laptops\Classes;

use Barrelblur\Laptops\Contracts\Resourceable;
use Barrelblur\Laptops\Tables\BrandTable;
use Barrelblur\Laptops\Tables\LaptopPropertyTable;
use Barrelblur\Laptops\Tables\LaptopTable;
use Barrelblur\Laptops\Tables\ModelTable;
use Barrelblur\Laptops\Tables\PropertiesTable;
use Bitrix\Main\Application;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\IO\FileNotFoundException;
use Bitrix\Main\IO\FileOpenException;
use Bitrix\Main\SystemException;

class MigrationManager
{
    /**
     * @var Resourceable[]
     */
    public static array $models = [
        BrandTable::class,
        ModelTable::class,
        LaptopTable::class,
        PropertiesTable::class,
        LaptopPropertyTable::class
    ];

    /**
     * @return void
     * @throws ArgumentException
     * @throws SystemException
     */
    public static function migrate(): void
    {
        foreach (static::$models as $model) {
            $model::getEntity()->createDbTable();
        }
    }

    /**
     * @return void
     * @throws \Bitrix\Main\DB\SqlQueryException
     */
    public static function rollback(): void
    {
        $connection = Application::getConnection();

        foreach (array_reverse(static::$models) as $model) {
            $tableName = $model::getTableName();

            if ($connection->isTableExists($tableName)) {
                $connection->dropTable($tableName);
            }
        }
    }

    /**
     * @return void
     * @throws FileNotFoundException
     * @throws FileOpenException
     * @throws ArgumentException
     * @throws SystemException
     * @throws \JsonException
     */
    public static function seed(): void
    {
        foreach (static::$models as $model) {
            $resourceFilename = $model::getResourceFilename();

            if (empty($resourceFilename)) {
                continue;
            }

            $loadedResource = static::loadResource($resourceFilename);

            if (!empty($loadedResource)) {
                $model::addMulti($loadedResource);
            }
        }
    }

    /**
     * @param string $filename
     *
     * @return array
     * @throws FileNotFoundException
     * @throws FileOpenException
     * @throws \JsonException
     */
    public static function loadResource(string $filename): array
    {
        $path = __DIR__ . '/../resources/' . $filename;

        if (!file_exists($path)) {
            throw new FileNotFoundException('File ' . $filename . ' is not existing');
        }

        $raw = file_get_contents($path);

        if ($raw === false) {
            throw new FileOpenException('Can\'t get content from ' . $filename);
        }

        $json = json_decode($raw, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \JsonException('Failed to parse JSON: ' . json_last_error_msg());
        }

        return $json;
    }
}
