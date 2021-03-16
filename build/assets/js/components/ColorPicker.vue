<template>
    <input class="ccm-widget-colorpicker" type="text" :name="inputName" :data-options="customOptions" ref="input"/>
</template>

<script>
import xw from '../translate/index'
const t = xw.t

export default {
    data: () => ({
        options: {
            cancelText: t('colorPicker.cancelText'),
            chooseText: t('colorPicker.chooseText'),
            togglePaletteMoreText: t('colorPicker.togglePaletteMoreText'),
            togglePaletteLessText: t('colorPicker.togglePaletteLessText'),
            noColorSelectedText: t('colorPicker.noColorSelectedText'),
            clearText: t('colorPicker.clearText'),
            className: 'ccm-widget-colorpicker',
            showInitial: true,
            showInput: true,
            allowEmpty: true,
            preferredFormat: 'rgb',
            showAlpha: false,
            appendTo: '.ui-dialog',
        }
    }),

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
