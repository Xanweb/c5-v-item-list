<template>
    <input class="ccm-widget-colorpicker" type="text" :name="inputName" :value="value" @input="$emit('input', $event.target.value)"/>
</template>

<script>
import {t} from '../translate/index'

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
        let options = { ...this.options }
        $.extend(true, options, this.customOptions)
        $(this.$el).spectrum(options)
    },

    props: {
        value: String,
        inputName: {
            type: String,
            required: true
        },
        customOptions: {
            type: Object,
            default: {},
            required: false
        }
    }
}
</script>
