require('./bootstrap');
import { createApp } from 'vue';
import App from './App.vue';
import router from './router'
import store from './stores'
import Select2 from 'vue3-select2-component';

// before a request is made start the loader
axios.interceptors.request.use(config => {
  switch(config.url)
  {
    case 'get-funds':
      break;
      case 'messages':
        break;
        case 'get-match-status':
          break;
    default:
      Startloader(true);
      break;
  }
  return config
})

// before a response is returned stop loader
axios.interceptors.response.use(response => {
  Startloader(false)
  return response
})

axios.interceptors.response.use(undefined, function (error) {
    if (error) {
      const originalRequest = error.config;
      if (error.response.status === 401 && !originalRequest._retry) {
          originalRequest._retry = true;
          localStorage.removeItem("currentUser");
          store.commit("auth/removeCurrentUser");
          router.push({name:'login'});
      }
      else{
        store.commit('handle_error',JSON.parse(error.response.data.error));
      }
    }
  })


const app = createApp(App);
app.use(router);
app.use(store);
app.component('Select2', Select2)
app.mount('#app');