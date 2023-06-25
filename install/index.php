<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Barrelblur\Laptops\Classes\MigrationManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

IncludeModuleLangFile(__FILE__);

class barrelblur_laptops extends CModule
{
    public $MODULE_ID = 'barrelblur.laptops';

    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;

    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;

    public $PARTNER_NAME;
    public $PARTNER_URI;

    public ?string $modulePath;
    public ?string $localPath;


    public function __construct()
    {
        $this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('PARTNER_NAME');
        $this->PARTNER_URI = Loc::getMessage('PARTNER_URI');

        $this->loadVersion();

        $this->localPath = $_SERVER['DOCUMENT_ROOT'] . '/local';
        $this->modulePath = __DIR__ . '/..';
    }

    public function DoInstall(): void
    {
        $step = $this->getStep();

        if ($step < 2) {
            $this->includeAdminFile(
                Loc::getMessage('INSTALL_TITLE'),
                '/install/step.php'
            );
        }

        if ($step == 2) {
            RegisterModule($this->MODULE_ID);

            if ($_REQUEST['refresh_tables'] === 'on') {
                $this->installDatabase();
            }

            $this->copyFiles();
        }
    }

    public function DoUninstall(): void
    {
        $step = $this->getStep();

        if ($step < 2) {
            $this->includeAdminFile(
                Loc::getMessage('UNINSTALL_TITLE'),
                '/install/unstep.php'
            );
        }

        if ($step == 2) {
            if ($_REQUEST['delete_tables'] === 'on') {
                $this->uninstallDatabase();
            }

            UnRegisterModule($this->MODULE_ID);
        }
    }

    public function installDatabase(): void
    {
        Loader::requireModule($this->MODULE_ID);

        MigrationManager::rollback();
        MigrationManager::migrate();
        MigrationManager::seed();
    }

    public function uninstallDatabase(): void
    {
        Loader::requireModule($this->MODULE_ID);

        MigrationManager::rollback();
    }

    public function copyFiles(): void
    {
        CopyDirFiles(
            $this->modulePath . '/install/components',
            $this->localPath . '/components',
            true,
            true
        );
    }

    public function loadVersion(): void
    {
        $arModuleVersion = [];

        include __DIR__ . '/version.php';

        if (isset($arModuleVersion['VERSION'])) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        }

        if (isset($arModuleVersion['MODULE_VERSION_DATE'])) {
            $this->MODULE_VERSION_DATE = $arModuleVersion['MODULE_VERSION_DATE'];
        }
    }

    public function getStep(): int
    {
        global $step;
        return intval($step);
    }

    public function includeAdminFile(string $title, $path): void
    {
        global $APPLICATION;

        $APPLICATION->IncludeAdminFile($title, $this->modulePath . $path);
    }
}
