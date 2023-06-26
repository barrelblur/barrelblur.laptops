<?

namespace Barrelblur\Laptops\Classes;

class URL
{
    public const URL_TEMPLATES = [
        'brands'  => 'index.php',
        'models'  => '#BRAND_CODE#/',
        'detail'  => 'detail/#LAPTOP_CODE#/',
        'laptops' => '#BRAND_CODE#/#MODEL_CODE#/',
    ];

    public static function parsePath(string $sefFolder): array
    {
        $variables = [];

        $template = \CComponentEngine::ParseComponentPath(
            $sefFolder,
            self::URL_TEMPLATES,
            $variables
        );

        if(!$template) $template = 'brands';

        return [$template, $variables];
    }
}
