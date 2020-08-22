import User from "../../Helpers/User";

const enstorefil = {
  state: {
    auth : {
      user: [],
    }
  },
  mutations: {
    SET_USER(state, user) {
      state.auth.user = user;
    },
  },
  actions: {
    async authUser({commit}){
      const userData = await User.auth()
      if(userData){
        commit('SET_USER', userData.data)
      }
    }
  },
  modules: {},
  getters: {
    isLoggedIn: state => state.auth.user
  }
};

export default enstorefil