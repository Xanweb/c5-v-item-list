<?php
namespace Xanweb\VItemList;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Foundation\Service\Provider as CoreServiceProvider;
use Concrete\Core\Support\Facade\Route;
use Xanweb\ExtAsset\Asset\VendorAssetManager;
use Xanweb\VItemList\Controller\JavascriptAssetDefaults;
use Xanweb\VItemList\Route\RouteList;

class ServiceProvider extends CoreServiceProvider
{
    public function register(): void
    {
        $this->registerAssets();
    }

    protected function registerAssets(): void
    {
        VendorAssetManager::registerMultiple([
            'xw/v-item-list' => [
                ['vendor-javascript', 'js/c5-item-list.js', 'xanweb/v-c5-item-list', ['minify' => false]],
                ['vendor-css', 'css/item-list.css', 'xanweb/v-c5-item-list', ['minify' => false]],
            ],
        ]);

        VendorAssetManager::registerGroupMultiple([
            'xanweb/v-item-list' => [
                [
                    ['javascript', 'jquery'],
                    ['javascript', 'underscore'],
                    ['vendor-javascript', 'xw/v-item-list'],
                    ['vendor-css', 'xw/v-item-list']                ],
            ],
        ]);
    }
}
