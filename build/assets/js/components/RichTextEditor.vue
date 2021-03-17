<template>
  <textarea :id="id" :name="inputName" class="form-control" v-model="model" :style="styles" @input="onInput"></textarea>
</template>

<script>
/* global _, xanweb */
export default {
    data: () => ({
        id: _.uniqueId('editor'),
        localValue: this.value,
    }),
    created() {
        this.setFieldValue()
    },
    mounted() {
        this.initEditor($(this.$el))
    },
    beforeDestroy() {
        this.destroyEditor($(this.$el))
    },
    methods: {
        setFieldValue() {
            this.value = this.model
        },
        onInput() {
            this.setFieldValue()
        }
    },
    computed: {
        model: {
            get() {
                return this.localValue
            },
            set(value) {
                if (value.constructor.toString().match(/function (\w*)/)[1].toLowerCase() !== 'inputevent') {
                    this.$nextTick(() => {
                        this.localValue = value
                    })
                }
            }
        },
        styles() {
            if (!(this.height > 0)) {
                return {}
            }

            return {
                'min-height': this.height + 'px'
            }
        }
    },
    watch: {
        model() {
            this.setFieldValue()
        },
        localValue(val) {
            this.$emit('input', val)
        },
        value(val) {
            this.localValue = val
        }
    },
    props: {
        inputName: {
            type: String,
            required: true
        },
        value: {
            type: String,
            default: ''
        },
        height: {
            type: Number,
            default: 0,
            required: false
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
