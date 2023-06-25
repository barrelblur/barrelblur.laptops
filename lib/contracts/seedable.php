<?

namespace Barrelblur\Laptops\Contracts;

interface Seedable
{
    public static function seed(array $resources): void;
}
