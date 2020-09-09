import User from "../../Helpers/User";
import { routes } from '../../routes.js';

const userstore = {
  state: {
  },
  mutations: {
  },
  actions: {

    async getUserProfile({commit}, id){
      return await User.getProfile(id)
      .then(response =>{
        return response.data.user_profile;
      })
      .catch(err => {
        return err.response.data.message;
      });
    },
  },
  modules: {},
  getters: {
  }
};

export default userstore