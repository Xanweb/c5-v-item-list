<template>
    <input class="ccm-widget-colorpicker" type="text" :name="inputName" :data-options="customOptions" ref="input"/>
</template>

<script>
    export default {
        data() {
            return {
                //Todo: Improve this
                options: {
                    cancelText: 'Cancel',
                    chooseText: 'Choose',
                    togglePaletteMoreText: 'more',
                    togglePaletteLessText: 'less',
                    noColorSelectedText: 'No Color Selected',
                    clearText: 'Clear Color Selection',
                    className: 'ccm-widget-colorpicker',
                    showInitial: true,
                    showInput: true,
                    allowEmpty: true,
                    preferredFormat: 'rgb',
                    showAlpha: false,
                    appendTo: '.ui-dialog',
                }
            }
        },

        mounted() {
            const $inputElement = $(this.$refs.input)
            let options = this.options
            if ($inputElement.data('options')) {
                $.extend(true, options, $inputElement.data('options'))
            }
            $inputElement.spectrum(options)
        },

        props: {
            inputName: {
                type: String,
                required: true
            },
            customOptions: {
                type: String,
                required: false
            }
        }
    }
</script>
