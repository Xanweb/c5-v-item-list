<template>
  <div class="item">
    <slot :item="item"></slot>
  </div>
</template>

<script>
import { ElementMixin, HandleDirective } from 'vue-slicksort';
export default {
  mixins: [ElementMixin],
  directives: { handle: HandleDirective },
  data() { return {} },
  props: {
    item: {
      type: Object,
      required: true
    }
  }
}
</script>