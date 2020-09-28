<template>
  <textarea :id="id" :name="inputName" class="form-control" ref="editor" v-model="currentValue">
    <slot />
  </textarea>
</template>

<script>
export default {
  data() {
    return {
      id: _.uniqueId('editor'),
      currentValue: this.getDefaultValue(),
      xwDefaults: $.extend({
        editor: {
          initRichTextEditor: editors => {}
        }
      }, xanweb || {})
    }
  },
  mounted() {
    this.initEditor($(this.$refs.editor))
  },
  methods: {
    getDefaultValue() {
      if (this.$slots.default && this.$slots.default.length) {
        return this.$slots.default[0].text
      }

      return ''
    }
  },
  props: {
    inputName: {
      type: String,
      required: true
    },
    initEditor: {
      type: Function,
      default(editors) {
        return this.xwDefaults.editor.initRichTextEditor(editors)
      }
    }
  }
}
</script>
