<template>
  <textarea :id="id" :name="inputName" class="form-control" ref="editor" v-model="currentValue">
    <slot />
  </textarea>
</template>

<script>
/* global _, xanweb */
export default {
    data: () => ({
        id: _.uniqueId('editor'),
        currentValue: this.getDefaultValue(),
    }),
    mounted() {
        this.initEditor($(this.$refs.editor))
    },
    destroyed() {
        this.destroyEditor($(this.$refs.editor))
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
            default() {
                if (!_.isUndefined(window['xanweb']) && _.isObject(xanweb)) {
                    return xanweb.editor.initRichTextEditor
                }

                return editors => {}
            }
        },
        destroyEditor: {
            type: Function,
            default() {
                if (!_.isUndefined(window['xanweb']) && _.isObject(xanweb)) {
                    return xanweb.editor.destroyRichTextEditor
                }

                return editors => {}
            }
        }
    }
}
</script>
