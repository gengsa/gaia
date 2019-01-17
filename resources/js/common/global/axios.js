import axios from 'axios';
import qs from 'qs';
import {
  Loading,
} from 'element-ui';
import { debounce } from 'lodash';
import Message from './message';



/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = axios;

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

axios.defaults.timeout = 1000 * 60;
/* eslint no-param-reassign: ["error", { "props": false }] */

let loadingCount = 0;
let loading;
const hideLoading = () => {
  if (loadingCount === 0) {
    loading.close();
  }
};

axios.interceptors.request.use((config) => {
  if (config.showLoading !== false) {
    if (loadingCount === 0) {
      loading = Loading.service({
        text: '',
        spinner: 'icon-loading',
        background: 'rgba(255, 255, 255, 0)',
      });
    }
    loadingCount += 1;
  }

  // TODO:
  if (config.method === 'post') {
    if (!config.headers['Content-Type']) {
      config.data = qs.stringify(config.data);
      config.headers['Content-Type'] = 'application/x-www-form-urlencoded';
      config.headers['X-Requested-With'] = 'XMLHttpRequest';
    }
  }
  return config;
}, error => Promise.reject(error));

axios.interceptors.response.use((response) => {
  if (response.config.showLoading !== false) {
    loadingCount -= 1;
    if (loadingCount === 0) {
      debounce(hideLoading, 100)();
    }
  }
  return response;
}, (error) => {
  // 判断error的response
  // 
  // eslint-disable-next-line
  // TODO 调整下面的代码
  window.error2 = error;
  loadingCount -= 1;
  if (loadingCount === 0) {
    debounce(hideLoading, 100)();
  }
  if (error.response.data !== undefined) {
    return Promise.reject(error);
  }
  Message({
    message: `Network error: ${error.message}`,
    type: 'error',
  });
//  return Promise.reject(error);
  return;
});
