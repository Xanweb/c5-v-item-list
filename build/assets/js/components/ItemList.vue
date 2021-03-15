<template>
  <div class="xw-item-list__items" >
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
            }, xanweb || {})
        }
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
