import Api from './Api';

const api_base = process.env.VUE_APP_API_BASE

export default {
  index(form) {
    return Api().get('/trips');
  },

  create(form) {
    return Api().post('/trips', form);
  },

  update(form, id) {
    return Api().put('/trips/' + id, form);
  },

  show(id) {
    return Api().get('/trips/' + id);
  },

  delete(id) {
    return Api().delete('/trips/' + id);
  }
}