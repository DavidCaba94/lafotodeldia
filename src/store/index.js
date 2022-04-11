import { createStore } from 'vuex'

export default createStore({
  state() {
    return {
      login: {
        id: 0,
        user: '',
        pass: '',
        email: '',
        foto: '',
        verificado: 0
      }
    }
  },
  mutations: {
    login(state, login) {
      state.login = login;
    },
    setStoredLogin(state, login) {
      state.login = login;
    },
    closeSession(state) {
      state.login.id = 0;
      state.login.user = '';
      state.login.pass = '';
      state.login.email = '';
      state.login.foto = '';
      state.login.verificado = 0;
    }
  },
  actions: {
  },
  modules: {
  }
})
