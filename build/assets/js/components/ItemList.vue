<template>
  <div class="xw-item-list__items" ref="list">
      <slot :deleteEvent="deleteItem"  :addNewItem="addNewItem"></slot>
  </div>
</template>

<script>
export default {
    data() {
        return {
            //todo: improve this
            xwDefaults: $.extend({
                i18n: {
                    confirm: 'Are you sure?',
                    maxItemsExceeded: 'Max items exceeded, you cannot add any more items.',
                    pageNotFound: 'Page not found'
                }
            }, xanweb || {}),

            newItemCreated: false
        }
    },
    updated() {
        this.$nextTick(function () {
            if(this.newItemCreated) {
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
          const defaultItem = { ...this.defaultItem }

          if (method == 'unshift') {
            this.items.unshift(defaultItem)
          } else {
            this.items.push(defaultItem)
          }
          this.newItemCreated = true
        },
        deleteItem(index) {
            if (confirm(this.xwDefaults.i18n.confirm)) {
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
          default: () => {
            return [];
          }
        },
        defaultItem: {
          type: Object,
          required: false,
          default: () => {
            return {}
          }
        },
        useDragHandle: {
          type: Boolean,
          default: true
        }
    }
}
</script>
