<template>
  <div class="item-list">
    <div class="item-list__menu">
      <slick-list lockAxis="y" v-model="items">
        <slick-item v-for="(item, index) in items" :index="index" :key="index">
          <item :key="index" :item="item">
            <template v-slot:item="slotProps">
              <slot name="item" :item="slotProps.item" :index="index" :deleteEvent="deleteItem">
              </slot>
            </template>
          </item>
        </slick-item>
      </slick-list>
    </div>
    <div class="item-list__setting">
      <slot name="setting" :addNewItem="addNewItem">
      </slot>
    </div>
  </div>
</template>
<script>
  import Item from './Item'
  import { SlickList, SlickItem } from 'vue-slicksort';
  export default {
    components: {
      Item,
      SlickList,
      SlickItem
    },
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