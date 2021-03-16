<template>
    <div class="item" ref="item">
        <i  class="btn drag-handle fas fa-arrows-alt"></i>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        mounted() {
            // Setup Choice Toggler
            const $item = $(this.$refs.item)
            $item.find('[data-choice]').each(function () {
                const group = $(this).data('choice')
                $(this).change(function (e) {
                    const $choiceGroup = $item.find(`[data-choice-group="${group}"]`)
                    $choiceGroup.hide()
                    $choiceGroup.filter(`[data-choice-value="${$(this).val()}"]`).show()
                }).trigger('change')
            })
        }
    }
</script>
