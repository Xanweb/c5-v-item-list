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
            'xw/item-list' => [
                ['vendor-javascript', 'js/c5-item-list.js', 'xanweb/item-list-vue', ['minify' => false]],
            ],
        ]);

        $al = AssetList::getInstance();
        $al->register('javascript-localized', 'xw/item-list/defaults', '/xw/item-list/js/defaults.js');

        VendorAssetManager::registerGroupMultiple([
            'xanweb/item-list-vue' => [
                [
                    ['javascript', 'jquery'],
                    ['javascript', 'underscore'],
                    ['javascript-localized', 'xw/item-list/defaults'],
                    ['vendor-javascript', 'xw/item-list'],
                ],
            ],
        ]);
    }
}
