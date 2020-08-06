<template>
  <section>
    <div class="field flex">
      <input
        v-model="comment"
        class="input"
        type="text"
        name="comment"
        placeholder="コメントを入力"
      />
      <input
        class="button is-primary"
        type="button"
        value="送信"
        @click="submit"
      />
    </div>
    <div class="comments">
      <div v-for="item in comments" :key="item.id">
        <span class="comment">{{ item.comment }}</span>
        <span class="comment_date">{{ formatDate(item.created_at) }}</span>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Comments',
  props: {
    comments: {
      type: Array,
    },
  },
  data() {
    return {
      comment: '',
    }
  },
  methods: {
    async submit() {
      const id = this.$route.params.id
      const comment = this.comment
      await this.$store.dispatch('setComment', { id, comment })
      this.comment = ''
      this.$store.dispatch('getComments')
    },
    formatDate(date) {
      return this.$moment(date).format('YYYY/MM/DD HH:mm')
    },
  },
}
</script>

<style scoped lang="scss">
.flex {
  display: flex;
  .button {
    margin-left: 10px;
  }
}
.comments {
  margin-top: 40px;
  > * {
    padding-bottom: 10px;
    margin-bottom: 10px;
    border-bottom: 1px solid #eee;
  }
}
.comment {
  display: block;
  word-break: break-all;
}
.comment_date {
  font-size: 12px;
  color: #999;
}
</style>
