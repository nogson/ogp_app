<template>
  <section class="section no-top-pad">
    詳細ページ
    <div class="columns is-centered is-mobile">
      <div class="column is-half-desktop is-full-mobile is-full-tablet">
        <h2 class="subtitle">
          {{ ogpData.message }}
          <img :src="ogpData.url" alt="" />
        </h2>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  async fetch({ app, store, route }) {
    const id = route.params.id
    await store.dispatch('getOPG', id)
  },
  computed: {
    ogpData() {
      console.log(this.$store.getters.ogpData)
      return this.$store.getters.ogpData
    },
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
          hid: 'og:url',
          property: 'og:url',
          content: window.location.href,
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
    }
  },
}
</script>

<style scoped lang="scss"></style>
