import User from "../../Helpers/User";
import { routes } from '../../routes.js';

const userstore = {
  state: {
    editing: false
  },
  mutations: {
    change_editing(state) {
      state.editing = !state.editing
    }
  },
  actions: {

    async get_user_profile({commit}, id){
      return await User.getProfile(id)
      .then(response =>{
        return response.data.user_profile;
      })
      .catch(err => {
        return err.response.data.message;
      });
    },
    async edit_general_settings({commit}, form) {
      return await User.editGeneralSettings(form)
      .then(response => {
        commit('auth_success', response.data.user);
        return {'message': 'Settings saved'}
      })
      .catch(err => {
        console.log(err.response);
      })
    },
    async edit_profile_image({commit}, form) {
      console.log(form);
      return await User.editProfileImage(form)
      .then(response => {
        commit('auth_success', response.data.user);
        return {'message': 'Profile picture changed'}
      })
      .catch(err => {
        console.log(err.response)
      })
    },
    async edit_password({commit}, form) {
      return await User.editPassword(form);
    },
    profile_editing({commit}) {
      commit('change_editing')
    }
  },
  modules: {},
  getters: {
    isEditing: state => state.editing
  }
};

export default userstore