<template>
  <div class="ccm-file-selector" ref="fileSelector"></div>
</template>

<script>
  export default {
    data: () => {return {}},
    mounted() {

      let option = {}
      option.inputName = this.inputName
      if (this.chooseText) {
        option.chooseText = this.chooseText
      }
      if (this.fileId) {
        option.fID = this.fileId
      }
      $(this.$refs.fileSelector).concreteFileSelector(option)
    },
    props: {
      inputName: {
        type: String,
        required: true
      },
      fileId: {
        type: Number,
        default: 0
      },
      chooseText: {
        type: String,
        required: false
      }
    }
  }
</script>