import Vue from "vue";
import Vuex from "vuex";
import modules from './modules';

Vue.use(Vuex);

export default new Vuex.Store({
  actions: {
    initialize: async (state) => {
      state.dispatch('authUser')
    }
  },
  modules: modules
});
