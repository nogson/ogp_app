<template>
  <section class="section no-top-pad">
    <div class="columns is-centered is-mobile">
      <div class="column is-half-desktop is-full-mobile is-full-tablet">
        <h2 class="subtitle">
          <img :src="ogpData.url" alt="" />
        </h2>
      </div>
    </div>
    <a
      href="https://twitter.com/share?ref_src=twsrc%5Etfw"
      class="twitter-share-button"
      data-show-count="false"
      >Tweet</a
    >
    <div class="comments-container">
      <h2 class="title is-5">コメント</h2>
      <comments :comments="comments" />
    </div>
  </section>
</template>

<script>
import Comments from '../../../components/Comments'
export default {
  components: { Comments },
  async fetch({ app, store, route }) {
    const id = route.params.id
    await store.dispatch('getOPG', id)
    await store.dispatch('getComments', { id })
  },
  computed: {
    ogpData() {
      return this.$store.getters.ogpData
    },
    comments() {
      return this.$store.getters.comments
    },
  },
  destroyed() {
    this.$store.commit('resetComment')
  },
  head() {
    return {
      title: 'OGPメッセージサービス',
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: 'OGPメッセージサービスの説明が入ります',
        },
        {
          hid: 'og:title',
          property: 'og:title',
          content: 'ページのタイトル',
        },
        {
          hid: 'og:type',
          property: 'og:type',
          content: 'article',
        },
        {
          hid: 'og:image',
          property: 'og:image',
          content: this.ogpData.url,
        },
        {
          hid: 'twitter:card',
          name: 'twitter:card',
          content: 'summary_large_image',
        },
        {
          hid: 'twitter:image',
          name: 'twitter:image',
          content: this.ogpData.url,
        },
        {
          hid: 'twitter:image:src',
          name: 'twitter:image:src',
          content: this.ogpData.url,
        },
      ],
      script: [{ src: 'https://platform.twitter.com/widgets.js' }],
    }
  },
}
</script>

<style scoped lang="scss"></style>
