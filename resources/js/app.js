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
import ProfileEditView from '../views/ProfileEditView.vue'
import ClassDetailView from '../views/ClassDetailView.vue'
import ClassPostView from '../views/ClassPostView.vue'
import PrivacyPolicyView from '../views/PrivacyPolicyView.vue'
import TermsView from '../views/TermsView.vue'
import ContactView from '../views/ContactView.vue'
import AboutUsView from '../views/AboutUsView.vue'
import NotFoundView from '../views/NotFoundView.vue'
import axios from 'axios';
// import store from '../store'; // Vuex ストアのインポート

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import { createRouter, createWebHistory } from 'vue-router';
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import { useStore } from 'vuex';
import store from '../store/index.js';

// const store = useStore()

const vuetify = createVuetify({
  components,
  directives,
})

const router = createRouter({
  history: createWebHistory(),
  routes: [

    { path: '/welcome', name: 'welcome', component: WelcomeView },
    { path: '/register', name: 'register', component: RegisterView },
    { path: '/login', name: 'login',component: LoginView },
    { path: '/reset-password', name: 'reset-password',component: RessetPasswordView, meta: { requiresAuth: true }, },
    // 後々/profileにmeta: { requiresAuth: true },を追加する(ログインしていないと見れない)
    { path: '/profile/',  name: 'profile', component: ProfileView},
    { path: '/profile/edit', name: 'profile/edit', component:  ProfileEditView, meta: { requiresAuth: true }, },
    { path: '/class', name: 'class', component: ClassListView },
    { path: '/class/detail', name: 'class/detail', component: ClassDetailView },
    { path: '/class/post', name: 'class/post', component: ClassPostView},
    { path: '/privacy-policy', name: 'privacy-policy', component: PrivacyPolicyView },
    { path: '/terms', name: 'terms', component: TermsView },
    { path: '/contact', name: 'contact', component: ContactView },
    { path: '/about-us', name: 'about-us', component: AboutUsView },
    { path: '/:catchAll(.*)', name: 'not-found', component: NotFoundView}
    // 設定画面を追加する.

  ]
});

router.beforeEach((to, from, next) => {
  // Check if the route requires authentication
  if (to.meta.requiresAuth) {
    // Check if the user is logged in
    if (store.getters.isLoggedIn) {
      // User is authenticated, proceed to the route
      next();
    } else {
      // User is not logged in, redirect to the login page
      next('/login');
    }
  } else {
    // Route does not require authentication, proceed
    next();
  }
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
.use(store)
.mount("#app")
