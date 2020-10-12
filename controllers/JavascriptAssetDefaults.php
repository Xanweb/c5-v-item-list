<?php
namespace Xanweb\VItemList\Controller;

use Concrete\Core\Controller\Controller;
use Concrete\Core\Http\ResponseFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Concrete\Core\Application\Application;

class JavascriptAssetDefaults extends Controller
{
    private $items;

    public function __construct(Application $app)
    {
        $this->setApplication($app);
        $this->items = [
            'i18n' => [
                'confirm' => t('Are you sure?'),
                'maxItemsExceeded' => t('Max items exceeded, You can not add any more items.'),
                'pageNotFound' => t('Page not found'),
            ],
        ];

        $config = $app->make('config');
        $initRichTextEditor = $config->get('xanweb.item_list.editor.initRichTextEditorJSFunc', function () use ($app) {
            return $app['editor']->getEditorInitJSFunction();
        });

        $destroyRichTextEditor = $config->get('xanweb.item_list.editor.destroyRichTextEditorJSFunc', function () {
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

        $this->setItem('editor.initRichTextEditor', $initRichTextEditor);
        $this->setItem('editor.destroyRichTextEditor', $destroyRichTextEditor);
    }

    public function setItem($key, $value)
    {
        $keys = explode('.', $key);
        list($namespace, $item) = $keys;
        if ($item) {
            unset($keys[0]);
            $this->items[$namespace] = $this->getNewItem(array_values($keys), $this->items[$namespace], $value);
        }else {
            $this->items[$namespace]= $value;
        }

        $this->app->instance(JavascriptAssetDefaults::class, $this);
    }

    private function getNewItem($keys, $default, $value)
    {
        list($namespace, $item) = $keys;
        if ($item) {
            unset($keys[0]);
            $default[$namespace] = $this->getNewItem(array_values($keys), $default[$namespace], $value);
        }else {
            $default[$namespace] = $value;
        }
        return $default;
    }

    private function getJsConfig($items)
    {
        $content = '{';
        foreach ($items as $key => $value) {
            $content .= '"' . $key . '": ';
            if (is_array($value)) {
                $content .= $this->getJsConfig($value) . ',';
            }else {
                if (substr(str_replace(' ', '', $value), 0, 8) == 'function') {
                    $content .= $value . ',';
                }else {
                    $content .= '"' . $value . '",';
                }
            }
        }
        $content .= '}';
        return $content;
    }

    public function getJavascript(): Response
    {
        $content = 'window.xanweb = $.extend(' . $this->getJsConfig($this->items) . ', window.xanweb || {});';

        return $this->createJavascriptResponse($content);
    }

    private function createJavascriptResponse(string $content): Response
    {
        $rf = $this->app->make(ResponseFactoryInterface::class);

        return $rf->create(
            $content,
            200,
            [
                'Content-Type' => 'application/javascript; charset=' . APP_CHARSET,
                'Content-Length' => strlen($content),
            ]
        );
    }
}
