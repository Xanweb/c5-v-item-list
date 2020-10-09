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
  },
  data() {
    return {
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
    },
    useDragHandle: {
      type: Boolean,
      default: true
    }
  }
}
</script>