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

    /**
     * @return self
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param string $sefFolder
     *
     * @return array
     */
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

    /**
     * @param string $sefFolder
     *
     * @return void
     */
    public function setDefaultSefFolder(string $sefFolder): void
    {
        $this->sefFolder = $sefFolder;
    }

    /**
     * @param string $brandCode
     *
     * @return string
     */
    public function getBrandUri(string $brandCode): string
    {
        return $this->sefFolder . str_replace('#BRAND_CODE#', $brandCode, self::URL_TEMPLATES['models']);
    }

    /**
     * @param string $brandCode
     * @param string $modelCode
     *
     * @return string
     */
    public function getModelUri(string $brandCode, string $modelCode): string
    {
        return $this->sefFolder . str_replace(
                ['#BRAND_CODE#', '#MODEL_CODE#'],
                [$brandCode, $modelCode],
                self::URL_TEMPLATES['laptops']
            );
    }

    /**
     * @param string $laptopCode
     *
     * @return string
     */
    public function getLaptopUri(string $laptopCode): string
    {
        return $this->sefFolder . str_replace('#LAPTOP_CODE#', $laptopCode, self::URL_TEMPLATES['detail']);
    }

    /**
     * @param array $parts
     *
     * @return string
     */
    public function toHref(array $parts): string
    {
        [$title, $link] = $parts;

        return '<a href="' . $link . '">' . $title . '</a>';
    }
}
