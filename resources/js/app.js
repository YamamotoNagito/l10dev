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

    { path: '/welcome', component: WelcomeView },
    { path: '/register', component: RegisterView },
    { path: '/login', component: LoginView },
    { path: '/resset-password', component: RessetPasswordView },
    { path: '/profile', component: ProfileView },
    { path: '/profile/edit', component:  ProfileEditView },
    { path: '/class-list', component: ClassListView },
    { path: '/class/detail', component: ClassDetailView },
    { path: '/class/post', component: ClassPostView },
    { path: '/privacy-policy', component: PrivacyPolicyView },
    { path: '/terms', component: TermsView },
    { path: '/contact', component: ContactView },
    { path: '/about-us', component: AboutUsView },

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