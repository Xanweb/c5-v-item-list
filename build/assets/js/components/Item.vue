<template>
  <div class="item">
    <slot></slot>
  </div>
</template>

<script>
import { ElementMixin, HandleDirective } from 'vue-slicksort';
export default {
  mixins: [ElementMixin],
  directives: { handle: HandleDirective },
  data() { return {} },
  props: {
  }
}
</script>