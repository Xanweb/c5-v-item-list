<template>
  <div class="item-list">
    <div class="item-list__menu">
      <item v-for="(item, index) in items" :key="index" :item="item">
        <template v-slot:item="slotProps">
          <slot name="item" :item="slotProps.item" :index="index" :deleteEvent="deleteItem">
          </slot>
        </template>
      </item>
    </div>
    <div class="item-list__setting">
      <slot name="setting" :addNewItem="addNewItem">
      </slot>
    </div>

  </div>
</template>

<script>
import Item from './Item'

export default {
  components: {
    Item,
  },
  mounted() {
    this.items = this.$props.startItems
  },
  data() {
    return {
      items: []
    }
  },
  methods: {
    addNewItem() {
      const defaultItem = { ...this.defaultItem }
      this.items.push(defaultItem)
    },
    deleteItem(index) {
      this.items.splice(index, 1)
    }
  },
  props: {
    addButtonText: {
      type: String,
      required: false,
      default: 'Add'
    },
    startItems: {
      type: Array,
      required: false,
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
    }
  }
}
</script>