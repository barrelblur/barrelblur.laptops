<?

namespace Barrelblur\Laptops\Classes;

class URL
{
    private static $instance;

    private string $sefFolder;

    private const URL_TEMPLATES = [
        'brands'  => 'index.php',
        'models'  => '#BRAND_CODE#/',
        'detail'  => 'detail/#LAPTOP_CODE#/',
        'laptops' => '#BRAND_CODE#/#MODEL_CODE#/',
    ];

    private function __construct() { }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function parsePath(string $sefFolder): array
    {
        $variables = [];

        $template = \CComponentEngine::ParseComponentPath(
            $sefFolder,
            self::URL_TEMPLATES,
            $variables
        );

        if (!$template) $template = 'brands';

        return [$template, $variables];
    }

    public function setDefaultSefFolder(string $sefFolder): void
    {
        $this->sefFolder = $sefFolder;
    }

    public function getBrandUri(string $brandCode): string
    {
        return $this->sefFolder . str_replace('#BRAND_CODE#', $brandCode, self::URL_TEMPLATES['models']);
    }

    public function toHref(array $parts): string
    {
        [$title, $link] = $parts;

        return '<a href="' . $link . '">' . $title . '</a>';
    }
}
