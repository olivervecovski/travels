import User from "../../Helpers/User";
import { routes } from '../../routes.js';

const userstore = {
  state: {
    status: '',
    user: {},
  },
  mutations: {
    auth_success(state, user) {
      state.status = 'success';
      state.user = user;
    },
    auth_error(state) {
      state.status = 'error';
      localStorage.removeItem('token');
    },
    logout(state) {
      state.status = '';
      state.user = {};
    }
  },
  actions: {

    async authUser({commit}){
      await User.auth()
      .then(response =>{
        if(response) commit('auth_success', response.data);
        else commit('logout');
      })
      .catch(err => {
        commit('logout');
      });
    },

    async login({commit, state}, form) {
      return await User.login(form)
      .then(response => {
        localStorage.setItem('token', response.data.access_token);
        commit('auth_success', response.data.user);
        let message = "Welcome back!";
        if(state.user.name.length > 0)
          message = "Welcome back, " + state.user.name + "!";
        return {'success': true, 'message': message};
      })
      .catch(error => {
        commit('auth_error');
        localStorage.removeItem('token');
        return {'success': false, 'message': error.response.data.message};
      });
    },

    async signup({commit}, form) {
      return await User.signup(form)
      .then(response => {
        return {'success': true, 'message': response.data.message};
      })
      .catch(error => {
        localStorage.removeItem('token');
        commit('auth_error');
        return {'success': false, 'message': error.response.data.message, 'errors': error.response.data.errors};
      })
    },

    logout({commit}) {
      return User.logout()
      .then(response => {
        commit('logout');
        localStorage.removeItem('token');
        return {'success': true, 'message': 'You are now logged out!'};
      })
    },

    async loginWithProvider({commit}, payload) {
      return await User.providerCallback(payload.provider, payload.query)
      .then(response => {
        if(!response.data.access_token) {
          commit('auth_error');
          return {'success': false, 'message': 'Something went wrong'};
        }
        localStorage.setItem('token', response.data.access_token);
        commit('auth_success', response.data.user);
        return {'success': true, 'message': "You are now signed in"};
      })
      .catch(err => {
        commit('auth_error');
        localStorage.removeItem('token');
        return {'success': false, 'message': err.data.message};
      })
    },

    async forgotPassword({commit}, form) {
      return await User.forgotPassword(form)
      .then(response => {
        return {'success': true, 'message': response.data.message};
      })
      .catch(err => {
        return {'success': false, 'message': err.data.message};
      })
    },
    async resetPassword({commit}, form) {
      return await User.resetPassword(form)
      .then(response => {
        return {'success': true, 'message': response.data.message};
      })
      .catch(err => {
        return {'success': false, 'message': err.data.message};
      })
    },
    async checkPasswordToken({commit}, form) {
      return await User.checkToken(form)
      .then(response => {
        return true;
      })
      .catch(err => {
        return {'message': err.data.message}
      });
    },
    async verifyEmail({commit}, form) {
      return await User.verifyEmail(form)
      .then(response => {
        return {'message': response.data.message, 'success': true};
      })
      .catch(err => {
        return {'message': err.response.data.message, 'success': false};
      })
    }
  },
  modules: {},
  getters: {
    isLoggedIn: state => state.status === 'success' ? true : false,
    user: state => state.user
  }
};

export default userstore