import { createStore } from 'vuex'

export default createStore({
  state() {
    return {
      login: {
        user: '',
        pass: ''
      }
    }
  },
  mutations: {
    login(state, login) {
      state.login = login;
    }
  },
  actions: {
  },
  modules: {
  }
})
