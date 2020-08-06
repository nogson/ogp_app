<template>
  <section class="section no-top-pad">
    <div id="js_capture_ref" class="OGPMessage" :class="bg">
      <span v-if="message" class="wf-hannari" v-html="outPutMessage" />
      <span v-else class="no-input">
        メッセージ
      </span>
      <div class="name">
        <span v-if="name" class="your-name">{{ name }}</span>
        <span v-else class="no-input your-name">名前</span>
      </div>
    </div>
    <div class="columns is-centered is-mobile">
      <div class="column is-half-desktop is-full-mobile is-full-tablet">
        <form>
          <div class="field">
            <div class="control"></div>
          </div>
          <div class="field">
            <label class="label">
              ことば
            </label>
            <div class="control">
              <textarea
                v-model="message"
                class="input row-5"
                name="message"
                placeholder="メッセージを入力してください"
              />
            </div>
          </div>
          <div class="field">
            <label class="label">
              名前
            </label>
            <div class="control">
              <input
                v-model="name"
                class="input"
                type="text"
                name="name"
                placeholder="名前を入力してください"
              />
            </div>
          </div>
          <div class="field">
            <label class="label">
              背景
            </label>
            <div class="bg-images">
              <span
                v-for="color in colors"
                :key="color"
                class="bg-img"
                :class="[{ act: isSelectedBg(color) }, color]"
                @click="selectBg(color)"
              />
            </div>
          </div>
          <div class="field">
            <div class="control ogp-btn">
              <client-only placholder="Loading...">
                <generate-o-g-p-button @click="handleGenerateOGP" />
              </client-only>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="messages-container">
      <h2 class="title is-5">
        <span class="icon has-text-primary mr-2">
          <i class="fa fa-comment"></i> </span
        >新着のことば
      </h2>
      <messages :messages="messages" />
      <div class="message-list-btn">
        <nuxt-link
          :to="`/message`"
          class="is-size-7 has-text-weight-semibold has-text-black"
        >
          <span class="icon has-text-primary">
            <i class="fa fa-comment"></i> </span
          >ことばをもっと見る
        </nuxt-link>
      </div>
    </div>
  </section>
</template>

<script>
import GenerateOGPButton from '../components/GenerateOGPButton'
import Messages from '../components/Messages'

export default {
  components: { Messages, GenerateOGPButton },
  async fetch({ app, store, route }) {
    await store.dispatch('getMessages')
  },
  data() {
    return {
      message: '',
      name: '',
      bg: 'bg-0',
      colors: [
        'bg-white',
        'bg-1',
        'bg-2',
        'bg-3',
        'bg-4',
        'bg-5',
        'bg-6',
        'bg-7',
        'bg-8',
        'bg-9',
        'bg-10',
        'bg-11',
        'bg-12',
        'bg-13',
        'bg-14',
        'bg-15',
        'bg-16',
      ],
    }
  },
  computed: {
    outPutMessage() {
      return this.message.replace(/\n/g, '<br />')
    },
    messages() {
      return this.$store.getters.messages
    },
    isSelectedBg() {
      return (bg) => {
        return this.bg === bg
      }
    },
  },
  methods: {
    handleGenerateOGP(e) {
      this.$store.dispatch('setMessage', {
        message: this.message,
        name: this.name,
        image: e,
      })
    },
    selectBg(bg) {
      this.bg = bg
    },
  },
  head: {
    link: [
      {
        rel: 'stylesheet',
        href: 'https://fonts.googleapis.com/earlyaccess/hannari.css',
      },
    ],
  },
}
</script>

<style lang="scss" scoped>
.your-message {
  font-size: 14px;
  display: block;
}

.no-input {
  color: #ccc;
}

.OGPMessage {
  position: relative;
  padding: 40px;
  font-size: 24px;
  font-weight: bold;
  text-align: center;
  border-radius: 10px;
  margin: 0 auto 30px;
  box-sizing: border-box;
  max-width: 1200px;
  max-height: 630px;
  border: 1px solid #ccc;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
.row-5 {
  height: calc(1.3em * 5);
  line-height: 1.3;
}

.your-name {
  font-size: 14px;
  font-weight: normal;
}

.messages-container {
  margin-top: 40px;
}
.ogp-btn {
  margin-top: 40px;
  text-align: center;
}
.message-list-btn {
  text-align: right;
  margin-top: 40px;
}
.bg-images {
  display: flex;
  flex-wrap: wrap;
}
.bg-img {
  width: 40px;
  height: 40px;
  display: block;
  margin-right: 10px;
  margin-bottom: 10px;
  cursor: pointer;
  box-sizing: border-box;
  border-radius: 4px;
  border: 1px solid #ccc;
  &.act {
    border: 2px solid $primary;
  }
}
.bg-white {
  background: #fff;
}
.bg-1 {
  background: url('~@/assets/images/bg-01.png');
}
.bg-2 {
  background: url('~@/assets/images/bg-02.png');
}
.bg-3 {
  background: url('~@/assets/images/bg-03.png');
}
.bg-4 {
  background: url('~@/assets/images/bg-04.png');
}
.bg-5 {
  background: url('~@/assets/images/bg-05.png');
}
.bg-6 {
  background: url('~@/assets/images/bg-06.png');
}
.bg-7 {
  background: url('~@/assets/images/bg-07.png');
}
.bg-8 {
  background: url('~@/assets/images/bg-08.png');
  color: #fff;
}
.bg-9 {
  background: url('~@/assets/images/bg-09.png');
}
.bg-10 {
  background: url('~@/assets/images/bg-10.png');
}
.bg-11 {
  background: url('~@/assets/images/bg-11.png');
}
.bg-12 {
  background: url('~@/assets/images/bg-12.png');
}
.bg-13 {
  background: url('~@/assets/images/bg-13.png');
}
.bg-14 {
  background: url('~@/assets/images/bg-14.jpg');
}
.bg-15 {
  background: url('~@/assets/images/bg-15.jpg');
  color: #fff;
}
.bg-16 {
  background: url('~@/assets/images/bg-16.jpg');
  color: #fff;
  background-size: contain;
}
.bg-red {
  background: $primary;
  color: #fff;
}
.bg-green {
  background: #38c867;
  color: #fff;
}
</style>
