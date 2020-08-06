<template>
  <section class="section no-top-pad">
    <messages :messages="messages" />
  </section>
</template>

<script>
import Messages from '../../components/Messages'
export default {
  name: 'Index',
  components: { Messages },
  async fetch({ app, store, route }) {
    await store.dispatch('getMessages')
  },
  computed: {
    messages() {
      return this.$store.getters.messages
    },
  },
}
</script>

<style scoped></style>
