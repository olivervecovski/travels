import axios from 'axios';

let BaseApi = axios.create({
  baseURL: '/api'
});

let Api = function() {
  let token = localStorage.getItem('token');
  let csrf = document.getElementById('csrf-token').getAttribute('content');

  if(token) {
    BaseApi.defaults.headers.common['Authorization'] = `Bearer ${token}`;
  }
  
  BaseApi.defaults.headers.common['CSRF-Token'] = csrf;
  BaseApi.defaults.headers.common['Accept'] = 'application/json';
  BaseApi.defaults.headers.common['Content-Type'] = 'application/json';

  return BaseApi;
}

export default Api;