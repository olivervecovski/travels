import Api from './Api';

const api_base = process.env.VUE_APP_API_BASE

export default {
  signup(form) {
    return Api().post('/auth/signup', form);
  },

  login(form) {
    return Api().post('/auth/login', form);
  },

  logout() {
    return Api().post('/auth/logout');
  },

  async auth() {
    let user;
    try{ user = await Api().get('/auth/user') }
    catch{ user = null }
    return user
  },

  refresh() {
    return Api().post('/auth/refresh');
  },

  socialLogin(provider) {
    return Api().get(`/auth/social/${provider}`);
  },

  providerCallback(provider, payload) {
    return Api().get(`/auth/social/${provider}/callback`, {
      params: payload
    });
  }
}