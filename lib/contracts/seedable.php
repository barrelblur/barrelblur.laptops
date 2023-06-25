<?

namespace Barrelblur\Laptops\Contracts;

interface Seedable
{
    public static function seed(array $resource): void;
}
