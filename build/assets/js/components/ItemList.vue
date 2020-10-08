<template>
  <div class="item-list">
    <div class="item-list__menu">
      <slot :items="items" :deleteEvent="deleteItem">
      </slot>
    </div>
    <div class="item-list__setting">
      <slot name="setting" :addNewItem="addNewItem">
      </slot>
    </div>

  </div>
</template>

<script>
import { ContainerMixin} from 'vue-slicksort';

export default {
  mixins: [ContainerMixin],
  mounted() {
  },
  data() {
    return {
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
    }
  }
}
</script>