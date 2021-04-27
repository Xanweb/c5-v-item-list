# Concrete5 VueJS Item List for ConcreteCMS V9

Manage your list of items easily without need to write a bunch of code

## Installation

Include library to your composer.json
```bash
composer require xanweb/c5-v-item-list
```

Add the service provider to `application/config/app.php`
```php
return [
    'providers' => [
        'xw_item_list' => '\Xanweb\ItemList\ServiceProvider'
    ],
];
```
or load it from you package on_start
```php
public function on_start()
{
    $this->app->make(\Concrete\Core\Foundation\Service\ProviderList::class)->registerProvider(\Xanweb\ItemList\ServiceProvider::class);
}
```

## Usage
1. Load optional assets depending on your needs:
    * Editor Assets (`$this->app['editor']->requireEditorAssets();`) if you need to use RichText Editor

2. Load required Item List Asset Group (`xanweb/v-item-list`)
3. Use Item List VueJS components:<br>
Here is an example
```vue 
<div id="app">
<item-list v-slot="slotProps" :items="items" :default-item="defaultItem" @add-item="onAddItem">
        <template>
            <div class="floating-block-actions">
                <button type="button" class="btn btn-primary btn-block" @click="slotProps.addNewItem"><?= t('Add Slide') ?></button>
            </div>
            <draggable v-model="items" handle=".drag-handle" v-bind="dragOptions" @start="drag = true" @end="drag = false">
                <transition-group type="transition" :name="!drag ? 'flip-list' : null">
                    <item class="card xw-item-list__item" v-for="(item, index) in items" :index="index" :key="item.id">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-xs-12 col-sm-7">
                                    <div class="float-left" data-concrete-file-input="<?= $uniqID ?>">
                                        <concrete-file-input :file-id="item.fID" v-model="item.fID" input-name="<?= $view->field('fID') ?>[]" choose-text="<?= t('Choose Image') ?>"></concrete-file-input>
                                    </div>
                                </div>
                                <div class="col-12 col-xs-12 col-sm-5 text-right pr-5">
                                    <div class="btn-group-sm">
                                        <button type="button" class="btn btn-secondary xw-item-list__edit-item xw-item-list__item-expander" data-toggle="collapse" :data-target="`.item--${index}`"><?= t('Edit') ?></button>
                                        <button type="button" class="btn btn-danger xw-item-list__remove-item"  @click="slotProps.deleteEvent(index)"><?= t('Remove') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div :class="`collapse item--${index}`">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="form-group">
                                        <?= $form->label('', t('Title')) ?>
                                        <?= $form->text($view->field('title') . '[]', ['id' => '', 'v-model' => 'item.title', 'maxlength' => 255]) ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?= $form->label('', t('Title Color')) ?>
                                                <color-picker input-name="<?= $view->field('titleColor') ?>[]" v-model="item.titleColor" :custom-options="colorPickerOptions"></color-picker>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?= $form->label('', t('Overlay Color')) ?>
                                                <color-picker input-name="<?= $view->field('overlayColor') ?>[]" v-model="item.overlayColor" :custom-options="colorPickerOptions"></color-picker>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?= $form->label('', t('Description')) ?>
                                        <rich-text-editor input-name="<?= $view->field('description') ?>[]" v-model="item.description" height="160"></rich-text-editor>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?= $form->label('', t('Box Color')) ?>
                                                <color-picker input-name="<?= $view->field('boxColor') ?>[]" v-model="item.boxColor" :custom-options="colorPickerOptions"></color-picker>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <?= $form->label('', t('Link Type')) ?>
                                                <?= $form->select($view->field('linkType') . '[]', $linkTypes, ['id' => '', 'v-model' => 'item.linkType', 'data-choice' => 'link-type', 'class' => 'bs-select']) ?>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div style="display: none;" class="form-group form-group-sm" data-choice-group="link-type" data-choice-value="1">
                                                <?= $form->label('', t('Page')) ?>
                                                <concrete-page-input :page-id="item.internalLinkCID"
                                                                     :include-system-pages="false" :ask-include-system-pages="false"
                                                                     input-name="<?= $view->field('internalLinkCID') ?>[]"
                                                                     choose-text="<?= t('Choose Page') ?>"  >
                                                </concrete-page-input>
                                            </div>
                                            <div style="display: none;" class="form-group form-group-sm" data-choice-group="link-type" data-choice-value="2">
                                                <?= $form->label('', t('URL')) ?>
                                                <?= $form->url($view->field('linkExtern') . '[]', ['id' => '', 'v-model' => 'item.linkExtern', 'maxlength' => 255]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="xw-item-entry-sort" type="hidden" name="<?= $view->field('sortOrder') ?>[]" :value="index"/>
                                </div>
                            </div>
                        </div>
                    </item>
                </transition-group>
            </draggable>
        </template>
    </item-list>
</div>    
```

5. Finally, we need to initialize our Vue app
```javascript
<script>
    Concrete.Vue.activateContext('itemList', function (Vue, config){
        new Vue({
            el: '#app',
            components: config.components,
            mounted() {
                $(this.$el).find('.bs-select').selectpicker()
            },
            methods: {
                onAddItem($item) {
                    $item.find('.bs-select').selectpicker()
                }
            },
            data: {
                drag: false,
                items: <?= json_encode($rows, JSON_NUMERIC_CHECK) ?>,
                colorPickerOptions: <?= json_encode($colorPickerOptions, JSON_NUMERIC_CHECK) ?>,
                useCustomThumbnailsSettings: <?= json_encode($useCustomThumbnailsSetting, JSON_NUMERIC_CHECK) ?>,
                defaultItem: {
                    get id() {
                        return _.uniqueId('item')
                    },
                    title: '',
                    fID: null,
                    description: '',
                    boxColor: 'rgba(0, 0, 0, 0.6)',
                    linkType: <?= json_encode(array_key_first($linkTypes)) ?>,
                    internalLinkCID: 0,
                    linkExtern: ''
                }
            },
            computed: {
                dragOptions() {
                    return {
                        animation: 200,
                        group: 'description',
                        disabled: false,
                        ghostClass: 'ghost'
                    };
                }
            }
        })
    });
</script>
```

## License
The Concrete5 Item List is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
