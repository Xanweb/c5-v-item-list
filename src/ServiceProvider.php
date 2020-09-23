<?php
namespace Xanweb\VItemListVue;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Foundation\Service\Provider as CoreServiceProvider;
use Concrete\Core\Support\Facade\Route;
use Xanweb\ExtAsset\Asset\VendorAssetManager;
use Xanweb\VItemListVue\Route\RouteList;

class ServiceProvider extends CoreServiceProvider
{
    public function register(): void
    {
        $router = Route::getFacadeRoot();
        $router->loadRouteList($this->app->build(RouteList::class));
        $this->registerAssets();
    }

    protected function registerAssets(): void
    {
        VendorAssetManager::registerMultiple([
            'xw/v-item-list' => [
                ['vendor-javascript', 'js/c5-item-list.js', 'xanweb/v-item-list', ['minify' => false]],
            ],
        ]);

        $al = AssetList::getInstance();
        $al->register('javascript-localized', 'xw/v-item-list/defaults', '/xw/v-item-list/js/defaults.js');

        VendorAssetManager::registerGroupMultiple([
            'xanweb/v-item-list' => [
                [
                    ['javascript', 'jquery'],
                    ['javascript', 'underscore'],
                    ['javascript-localized', 'xw/v-item-list/defaults'],
                    ['vendor-javascript', 'xw/v-item-list'],
                ],
            ],
        ]);
    }
}
