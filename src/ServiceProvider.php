<?php

namespace Xanweb\C5\VueItemList;

use Xanweb\C5\JsLocalization\Event\BackendAssetLocalizationLoad;
use Xanweb\ExtAsset\Asset\VendorAssetManager;
use Xanweb\C5\JsLocalization\ServiceProvider as JavascriptDefaultsServiceProvider;

class ServiceProvider extends JavascriptDefaultsServiceProvider
{
    public function _register(): void
    {
        parent::_register();

        $this->registerListeners();
        $this->registerAssets();
    }

    private function registerListeners(): void
    {
        $this->app['director']->addListener(BackendAssetLocalizationLoad::NAME, function (BackendAssetLocalizationLoad $event) {
            $event->getAssetLocalization()->mergeWith([
                'i18n' => [
                    'confirm' => t('Are you sure?'),
                    'maxItemsExceeded' => t('Max items exceeded, you cannot add any more items.'),
                    'pageNotFound' => t('Page not found'),
                    'colorPicker' => [
                        'cancelText' => t('Cancel'),
                        'chooseText' => t('Choose'),
                        'togglePaletteMoreText' => t('more'),
                        'togglePaletteLessText' => t('less'),
                        'noColorSelectedText' => t('No Color Selected'),
                        'clearText' => t('Clear Color Selection'),
                    ]
                ],
                'editor' => [
                    'initRichTextEditor' => $this->getInitRichTextEditorJSFunction(),
                    'destroyRichTextEditor' => $this->getDestroyRichTextEditorJSFunction(),
                ],
            ]);
        });
    }

    private function getDestroyRichTextEditorJSFunction()
    {
        return $this->app['config']->get('xanweb.item_list.editor.destroyRichTextEditorJSFunc', function () {
            return <<<EOT
function (editor) {
    var id = editor.attr('id');
    if (CKEDITOR.instances[id] !== undefined) {
        CKEDITOR.instances[id].destroy();
    }

    editor.remove();
    $('#cke_' + id).remove();
}
EOT;
        });
    }

    private function getInitRichTextEditorJSFunction()
    {
        return $this->app['config']->get('xanweb.item_list.editor.initRichTextEditorJSFunc', function () {
            return $this->app['editor']->getEditorInitJSFunction();
        });
    }

    protected function registerAssets(): void
    {
        VendorAssetManager::registerMultiple([
            'xw/v-item-list' => [
                ['vendor-javascript', 'js/v-item-list.js', 'xanweb/c5-v-item-list', ['minify' => false]],
                ['vendor-css', 'css/v-item-list.css', 'xanweb/c5-v-item-list', ['minify' => false]],
            ],
        ]);

        VendorAssetManager::registerGroupMultiple([
            'xanweb/v-item-list' => [
                [
                    ['vendor-javascript', 'xw/v-item-list'],
                    ['javascript-localized', 'xw/backend'],
                    ['vendor-css', 'xw/v-item-list'],
                ],
            ],
        ]);
    }
}
