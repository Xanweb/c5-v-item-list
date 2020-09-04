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
      initCompactEditor: editor => {}
    }
  },
  mounted() {
    this.initCompactEditor = ccm_xan.editor.initCompactEditor
    this.initCompactEditor($(this.$refs.editor))
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
    }
  }
}
</script>
