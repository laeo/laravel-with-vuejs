import token from '@/api/token';

const state = {
  token : sessionStorage.getItem('token'),
}

const getters = {
  fulfilledToken (state) {
    if (state.token === null) {
      return null;
    }

    return 'Bearer ' + state.token;
  },
  isValidated (state) {
    return state.token !== null;
  }
}

const mutations = {
  setToken (state, { token }) {
    state.token = token;
    sessionStorage.setItem('token', state.token);
  },
  clearToken (state) {
    state.token = null;
    sessionStorage.removeItem('token');
  },
}

const actions = {
  create ({ commit, dispatch }, credentials) {
    return token.create(credentials).then(m => {
        commit('setToken', m.data);

        return m.message;
    });
  },
  delete ({ commit }) {
    return token.delete().then(() => {
      commit('clearToken');
    });
  }
}


export default {
  state,
  getters,
  mutations,
  actions
}