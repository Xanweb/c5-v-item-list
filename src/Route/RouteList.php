<?php
namespace Xanweb\VItemList\Route;

use Concrete\Core\Routing\RouteListInterface;
use Concrete\Core\Routing\Router;

class RouteList implements RouteListInterface
{
    public function loadRoutes(Router $router)
    {
        $router->buildGroup()
            ->setNamespace('Xanweb\VItemList\Controller')
            ->routes(function (Router $r) {
                $r->get('/xw/v-item-list/js/defaults.js', 'JavascriptAssetDefaults::getJavascript');
            });
    }
}
