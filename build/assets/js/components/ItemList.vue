<template>
  <div class="xw-item-list__items" ref="list">
      <slot :items="items" :deleteEvent="deleteItem" :addNewItem="addNewItem"></slot>
  </div>
</template>

<script>
import {t} from '../translate/index'

export default {
    methods: {
        addNewItem(method = 'push') {
            const itemsCount = this.items.length
            if (this.maxItemsCount > 0 && itemsCount >= this.maxItemsCount) {
                alert(t('maxItemsExceeded'))
                return false
            }

            const defaultItem = {...this.defaultItem}
            if (method === 'unshift') {
                this.items.unshift(defaultItem)
            } else {
                this.items.push(defaultItem)
            }

            this.$nextTick(() => {
                const $container = $(this.$refs.list)
                const $newItem = $container.find('.xw-item-list__item').last()
                $newItem.find('.xw-item-list__item-expander').trigger('click')
                const $uiDialog = $container.closest('.ui-dialog-content.ui-widget-content')
                let scroll = $uiDialog.prop('scrollHeight')
                $uiDialog.animate({
                    scrollTop: scroll
                }, 'slow')

                this.$emit('add-item', $newItem)
            })
        },
        deleteItem(index) {
            if (confirm(t('confirm'))) {
                this.items.splice(index, 1)
            }
        }
    },
    props: {
        items: {
          type: Array,
          default: () => []
        },
        defaultItem: {
          type: Object,
          required: true
        },
        useDragHandle: {
          type: Boolean,
          default: true
        },
        maxItemsCount: {
            type: Number,
            default: 100,
            required: false
        },
    }
}
</script>
<style lang="scss" scoped>
.xw-item-list__items::v-deep {
    .flip-list-move {
        transition: transform 0.5s;
    }
    .no-move {
        transition: transform 0s;
    }
    .ghost {
        opacity: 0.5;
        background: #c8ebfb;
    }
}
</style>
