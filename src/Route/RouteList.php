<?php
namespace Xanweb\VItemListVue\Route;

use Concrete\Core\Routing\RouteListInterface;
use Concrete\Core\Routing\Router;

class RouteList implements RouteListInterface
{
    public function loadRoutes(Router $router)
    {
        $router->buildGroup()
            ->setNamespace('Xanweb\ItemList\Controller')
            ->routes(function (Router $r) {
                $r->get('/xw/v-item-list/js/defaults.js', 'JavascriptAssetDefaults::getJavascript');
            });
    }
}
