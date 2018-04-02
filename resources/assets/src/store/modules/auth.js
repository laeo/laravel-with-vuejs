import token from '@/api/token';

const state = {
  token : sessionStorage.getItem('token'),
}

const getters = {
  isAuthenticated (state) {
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
  authenticate ({ commit, dispatch }, credentials) {
    return token.create(credentials).then(m => {
        commit('setToken', m.payload);

        return m.message;
    });
  },
  invalidate ({ commit }) {
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