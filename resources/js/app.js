import { createApp } from 'vue/dist/vue.esm-bundler.js';
import App from '../views/App.vue'
import LoginView from '../views/LoginView.vue'
import WelcomeView from '../views/WelcomeView.vue'
import ProfileView from '../views/ProfileView.vue'
import RegisterView from '../views/RegisterView.vue'
import RessetPasswordView from '../views/RessetPasswordView.vue'
import ClassListView from '../views/ClassListView.vue'
import ReviewListView from '../views/ReviewListView.vue'
import ReviewFormView from '../views/ReviewFormView.vue'
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
    { path: '/resset_password', component: RessetPasswordView },
    { path: '/class_list', component: ClassListView },
    { path: '/review_list', component: ReviewListView },
    { path: '/review_form', component: ReviewFormView },
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