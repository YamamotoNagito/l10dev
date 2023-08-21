import { createApp } from 'vue/dist/vue.esm-bundler.js';
import App from '../components/App.vue'
import LoginView from '../components/LoginView.vue'
import WelcomeView from '../components/WelcomeView.vue'
import ProfileView from '../components/ProfileView.vue'
import RegisterView from '../components/RegisterView.vue'
import axios from 'axios';

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import { createRouter, createWebHistory } from 'vue-router';
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
})

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: WelcomeView },
    { path: '/login', component: LoginView },
    { path: '/profile', component: ProfileView },
    { path: '/register', component: RegisterView },
  ]
});

// createApp({
//     components: {
//           App,
//           LoginView,
//   },
// })
createApp(App)
.use(vuetify)
.use(router)
.mount("#app")