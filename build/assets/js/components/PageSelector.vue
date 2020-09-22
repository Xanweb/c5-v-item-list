<template>
  <div class="page-selector" ref="pageSelector"></div>
</template>

<script>
  export default {
    data: () => {return {}},
    mounted() {
      let option = {}
      option.inputName = this.inputName
      if (this.pageId) {
        option.cID = this.$props.pageId;
      }
      if (this.chooseText) {
        option.chooseText = this.chooseText
      }
      $(this.$refs.pageSelector).concretePageSelector(option)
    },
    props: {
      chooseText: {
        type: String,
        required: false
      },
      inputName: {
        type: String,
        required: true
      },
      pageId: {
        type: Number,
        required: false
      }
    }
  }
</script>
