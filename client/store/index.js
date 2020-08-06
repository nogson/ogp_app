export const state = () => ({
  message: '',
  isLoading: false,
  ogpData: {},
  messages: [],
  comments: [],
})

export const mutations = {
  setMessage(state, payload) {
    state.message = payload
  },
  setLoading(state, payload) {
    state.isLoading = payload
  },
  setOGP(state, payload) {
    state.ogpData = payload
  },
  setMessages(state, payload) {
    state.messages = payload
  },
  setComments(state, payload) {
    state.comments = payload
  },
  resetComment(state) {
    state.comments = []
  },
}

export const actions = {
  async setMessage({ commit }, payload) {
    const id = await this.$axios.$post('/api/message', payload)
    if (id) {
      this.$router.push(`/message/${id}/`)
    }
  },
  setLoading({ commit }, payload) {
    commit('setLoading', payload)
  },
  async getOPG({ commit }, payload) {
    const data = await this.$axios.$get(`/api/message/${payload}`)
    commit('setOGP', data)
  },
  async getMessages({ commit }, payload) {
    const data = await this.$axios.$get('/api/messages')
    commit('setMessages', data)
  },
  async setComment({ getters, commit }, payload) {
    await this.$axios.$post(`/api/comment/${payload.id}`, {
      comment: payload.comment,
    })
  },
  async getComments({ commit }, payload) {
    const data = await this.$axios.$get('/api/comments', {
      params: {
        id: payload.id,
      },
    })
    commit('setComments', data)
  },
}

export const getters = {
  message(state) {
    return state.message
  },
  loading(state) {
    return state.loading
  },
  ogpData(state) {
    return state.ogpData
  },
  messages(state) {
    return state.messages
  },
  comments(state) {
    return state.comments
  },
}
