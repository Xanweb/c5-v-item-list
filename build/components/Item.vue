<template>
  <div class="item">
    <slot name="item" :item="item"></slot>
  </div>
</template>

<script>

export default {
  data() { return {} },
  props: {
    item: {
      type: Object,
      required: true
    }
  }
}
</script>