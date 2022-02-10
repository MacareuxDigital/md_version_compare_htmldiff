<?php

namespace Concrete\Package\MdVersionCompareHtmldiff;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Package\Package;
use Concrete\Core\Routing\Router;

class Controller extends Package
{
    protected $pkgHandle = 'md_version_compare_htmldiff';
    protected $appVersionRequired = '8.5.5';
    protected $pkgVersion = '0.0.1';

    public function getPackageName()
    {
        return t('Macareux Versions Diff');
    }

    public function getPackageDescription()
    {
        return t('Replace Version Compare panel to HtmlDiff instead of tabs.');
    }

    public function install()
    {
        if (!file_exists($this->getPackagePath() . '/vendor/autoload.php')) {
            throw new Exception(t('Required libraries not found.'));
        }

        return parent::install();
    }

    public function on_start()
    {
        /** @var Router $router */
        $router = $this->app->make(Router::class);
        $router->all('/ccm/system/panels/details/page/versions', '\Concrete\Package\MdVersionCompareHtmldiff\Controller\Panel\Detail\Page\Versions::view');
        $router->all('/ccm/md/version_compare', '\Concrete\Package\MdVersionCompareHtmldiff\Controller\VersionCompare::view');

        $assetList = AssetList::getInstance();
        $assetList->register('css', 'md_htmldiff', 'css/htmldiff.css', [], $this->getPackageEntity());
        $assetList->register('javascript', 'md_htmldiff', 'js/htmldiff.js', [], $this->getPackageEntity());
        $assetList->registerGroup('md_htmldiff', [
            ['css', 'md_htmldiff'],
            ['javascript', 'md_htmldiff']
        ]);

        $this->registerAutoload();
    }

    protected function registerAutoload()
    {
        require $this->getPackagePath() . '/vendor/autoload.php';
    }
}
