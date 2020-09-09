import User from "../../Helpers/User";
import { routes } from '../../routes.js';

const userstore = {
  state: {
  },
  mutations: {
  },
  actions: {

    async getUserProfile({commit}){
      await User.auth()
      .then(response =>{
        console.log(response.data)
        if(response) commit('auth_success', response.data);
        else commit('logout');
      })
      .catch(err => {
      });
    },
  },
  modules: {},
  getters: {
  }
};

export default userstore