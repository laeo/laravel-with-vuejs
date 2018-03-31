// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import App from './App';
import api from '@/api/api';
import router from '@/router';
import store from '@/store';

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>',
  beforeMount () {
    //在此中间件中添加身份认证所需 token。
    api.interceptors.request.use(config => {
      config.headers['Authorization'] = this.$store.getters.fufilledToken;
      return config;
    });

    //在此中间件中对数据进行预处理，具体 res 结构请查询 axios 文档。
    api.interceptors.response.use(res => {
      if (res.headers.authorization !== undefined) {
        this.$store.commit('setToken', {
          accessToken: res.headers.authorization,
          tokenType: 'Bearer'
        });
      }

      return res.data;
    });
  }
})
