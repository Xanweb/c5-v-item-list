<template>
  <textarea :id="id" :name="inputName" class="form-control" v-model="model" :style="styles" @input="onInput"></textarea>
</template>

<script>
/* global _, xanweb */
export default {
    data: () => ({
        id: _.uniqueId('editor'),
        localValue: '',
    }),
    mounted() {
        this.model = this.value
        this.initEditor($(this.$el))
        this.$nextTick(() => {
            _.delay(() => {
                $(this.$el).parent().find('div.cke_wysiwyg_div').css(this.styles)
            }, 1000)
        })
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
                this.localValue = value
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
        value: {
            type: String,
            default: '',
        },
        inputName: {
            type: String,
            required: true
        },
        height: {
            type: Number,
            default: 0,
            required: false
        },
        initEditor: {
            type: Function,
            default: editors => {
                if (!_.isUndefined(window['xanweb']) && _.isObject(xanweb)) {
                    return xanweb.editor.initRichTextEditor(editors)
                }
            }
        },
        destroyEditor: {
            type: Function,
            default: editors => {
                if (!_.isUndefined(window['xanweb']) && _.isObject(xanweb)) {
                    return xanweb.editor.destroyRichTextEditor(editors)
                }
            }
        }
    }
}
</script>
