import token from '@/api/token';

const state = {
  accessToken : sessionStorage.getItem('accessToken'),
  tokenType   : sessionStorage.getItem('tokenType')
}

const getters = {
  fulfilledToken (state) {
    if (state.accessToken === null) {
      return null;
    }

    return state.tokenType + ' ' + state.accessToken;
  },
  isValidated (state) {
    return state.accessToken !== null && state.tokenType !== null;
  }
}

const mutations = {
  setToken (state, { accessToken, tokenType }) {
    state.accessToken = accessToken;
    state.tokenType   = tokenType;
    sessionStorage.setItem('accessToken', state.accessToken);
    sessionStorage.setItem('tokenType', state.tokenType);
  },
  clearToken (state) {
    state.accessToken = null;
    state.tokenType   = null;
    sessionStorage.removeItem('accessToken');
    sessionStorage.removeItem('tokenType');
  },
}

const actions = {
  create ({ commit, dispatch }, credentials) {
    return token.create(credentials).then(m => {
        commit('setToken', m.data);

        return m.message;
    });
  },
  refresh ({ getters, commit }) {
    return token.refresh(getters.authToken).then(m => {
      commit('setToken', m.data);
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