<template>
  <div class="xw-item-list__items" ref="list">
      <slot :deleteEvent="deleteItem"  :addNewItem="addNewItem"></slot>
  </div>
</template>

<script>
import xw from '../translate/index'
const t = xw.t

export default {
    data: () => ({
        maxItemsCount: 100,
        newItemCreated: false
    }),
    updated() {
        this.$nextTick(function () {
            if (this.newItemCreated) {
                const $container = $(this.$refs.list)
                const $newItem = $container.find('.xw-item-list__item').last()
                $newItem.find('.xw-item-list__item-expander').trigger('click')
                const $uiDialog = $container.closest('.ui-dialog-content.ui-widget-content')
                let scroll = $uiDialog.prop('scrollHeight')

                $uiDialog.animate({
                    scrollTop: scroll
                }, 'slow')

                this.newItemCreated = false
            }
        })
    },
    methods: {
        addNewItem(method) {
            method = method || null
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

            this.newItemCreated = true
        },
        deleteItem(index) {
            if (confirm(t('confirm'))) {
                this.items.splice(index, 1)
            }
        }
    },
    props: {
        addButtonText: {
          type: String,
          required: false,
          default: 'Add'
        },
        items: {
          type: Array,
          default: () => []
        },
        defaultItem: {
          type: Object,
          required: false,
          default: () => ({})
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
