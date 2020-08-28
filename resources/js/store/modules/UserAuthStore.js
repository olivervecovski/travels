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
    },
    logout(state) {
      state.status = '';
      state.user = {};
    }
  },
  actions: {
    async authUser({commit}){
      const userData = await User.auth()
      .then(response =>{
        commit('auth_success', response.data)
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
        return {'succcess': false, 'message': 'The provided credentials are incorrect!'};
      });
    },
    async signup({commit}, form) {
      return await User.signup(form)
      .then(response => {
        localStorage.setItem('token', response.data.access_token);
        commit('auth_success', response.data.user);
        return {'succcess': true, 'message': 'Successfully signed up!'};
      })
      .catch(error => {
        localStorage.removeItem('token');
        commit('auth_error');
        return {'succcess': false, 'message': error.response.data.message, 'errors': error.response.data.errors};
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
    async loginWithProvider({commit}, provider, query) {
      return await User.providerCallback(provider, query)
      .then(response => {
        localStorage.setItem('token', response.data.access_token);
        commit('auth_success', response.data.user);
        return {'success': true, 'message': "You are now signed in"};
      })
      .catch(err => {
        commit('auth_error');
        localStorage.removeItem('token');
        return {'success': false, 'message': err.data.message};
      })
    }
  },
  modules: {},
  getters: {
    isLoggedIn: state => state.status === 'success' ? true : false
  }
};

export default userstore