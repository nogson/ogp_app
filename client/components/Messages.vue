<template>
  <section class="messages">
    <article v-for="item in messages" :key="item.id">
      <nuxt-link :to="`/message/${item.id}`">
        <p class="message">{{ item.message }}</p>
        <p class="name">{{ item.name }}</p>
      </nuxt-link>
    </article>
  </section>
</template>

<script>
export default {
  name: 'Messages',
  props: {
    messages: {
      type: Array,
      default: () => [],
    },
  },
}
</script>

<style scoped lang="scss">
.messages {
  display: flex;
  flex-wrap: wrap;
  > * {
    display: flex;
    width: calc((100% - 20px * 2) / 3);
    padding: 20px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    &:not(:last-child) {
      margin-right: 20px;
    }
    > * {
      text-align: center;
      width: 100%;
    }
    @media screen and (max-width: $mobile) {
      width: 100%;
      margin-right: 0 !important;
    }
  }
  .message {
    font-weight: bold;
    margin-bottom: 10px;
    color: #4a4a4a;
    word-break: break-all;
  }
  .name {
    font-size: 12px;
    color: #4a4a4a;
  }
}
</style>
