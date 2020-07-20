<template>
  <div class="wrap">
    <div ref="capture" class="button is-primary" @click="createOGP">
      OGPイメージを作成する
    </div>
  </div>
</template>

<script>
export default {
  name: 'GenerateOGPButton',
  data() {
    return {
      h2c: null,
    }
  },
  mounted() {
    // const elm = this.$refs.capture
    // const self = this
    this.$nextTick(() => {
      this.h2c = require('html2canvas')
    })
  },
  methods: {
    createOGP() {
      this.$store.dispatch('setLoading', true)
      window.scrollTo(0, 0)

      this.h2c(document.querySelector('#js_capture_ref'), {
        backgroundColor: '#fff',
      }).then((canvas) => {
        canvas.toBlob((blob) => {
          const reader = new FileReader()
          reader.readAsDataURL(blob)
          reader.onload = () => {
            const dataURI = reader.result
            this.handleClick(dataURI)
          }
        })
      })
    },
    handleClick(dataURI) {
      this.$emit('click', dataURI)
    },
  },
}
</script>

<style scoped lang="scss"></style>
