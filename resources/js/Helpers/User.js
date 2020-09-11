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
    return await Api().get('/auth/user')
      .then(response => response.data)
      .catch(() => null)
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
  },

  forgotPassword(form) {
    return Api().post('/auth/forgot-password', form);
  },

  resetPassword(form) {
    return Api().post('/auth/reset-password', form);
  },

  checkToken(form) {
    return Api().post('/auth/check-token', form);
  },

  verifyEmail(form) {
    return Api().get('/auth/email-verification', {
      params: form
    });
  },

  getProfile(id) {
    return Api().get(`/users/${id}`);
  },

  editGeneralSettings(form) {
    return Api().post('/users/general', form);
  }
}