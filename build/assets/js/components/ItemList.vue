<template>
  <div class="item-list">
    <slot :items="items" :deleteEvent="deleteItem" :addNewItem="addNewItem">
    </slot>
  </div>
</template>

<script>
import { ContainerMixin} from 'vue-slicksort';

export default {
  mixins: [ContainerMixin],
  mounted() {
    this.useDragHandle = true
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