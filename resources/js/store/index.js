import Vue from "vue";
import Vuex from "vuex";
import modules from './modules';

Vue.use(Vuex);
export default new Vuex.Store({
  state: {
    loaded: false
  },
  actions: {
    async initialize ({commit, dispatch}){
      await dispatch('authUser');
      await dispatch('getTrips');
      commit('setloaded', true);
    }
  },
  modules: modules,
  mutations: {
    setloaded(state, payload) {
      state.loaded = payload;
    }
  },
  getters: {
    loaded: state => {
      return state.loaded
    }
  }
});
