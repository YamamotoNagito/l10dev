import { createApp } from "vue/dist/vue.esm-bundler.js";
import App from "../views/App.vue";
import LoginView from "../views/LoginView.vue";
import WelcomeView from "../views/WelcomeView.vue";
import ProfileView from "../views/ProfileView.vue";
import RegisterView from "../views/RegisterView.vue";
import RessetPasswordView from "../views/RessetPasswordView.vue";
import ClassListView from "../views/ClassListView.vue";
import ReviewListView from "../views/ReviewListView.vue";
import ReviewFormView from "../views/ReviewFormView.vue";
import ProfileEditView from "../views/ProfileEditView.vue";
import ClassDetailView from "../views/ClassDetailView.vue";
import ClassPostView from "../views/ClassPostView.vue";
import PrivacyPolicyView from "../views/PrivacyPolicyView.vue";
import TermsView from "../views/TermsView.vue";
import ContactView from "../views/ContactView.vue";
import NotFoundView from "../views/NotFoundView.vue";
import { createRouter, createWebHistory } from "vue-router";
// import store from '../store'; // Vuex ストアのインポート

// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import "@mdi/font/css/materialdesignicons.css";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

import { useStore } from "vuex";
import store from "../store/index.js";

// const store = useStore()

// TODO: plugins/vuetify.jsに移動する
const vuetify = createVuetify({
  components,
  directives,
  theme: {
    options: {
      customProperties: true,
    },
    defaultTheme: "light",
    themes: {
      light: {
        dark: false,
        colors: {
          background: "#ECEFF1",
          surface: "#FFFFFF",
          primary: "#6200EE",
          "primary-darken-1": "#3700B3",
          secondary: "#03DAC6",
          "secondary-darken-1": "#018786",
          error: "#B00020",
          info: "#2196F3",
          success: "#4CAF50",
          warning: "#FB8C00",
        },
      },
    },
  },
});

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/welcome", name: "welcome", component: WelcomeView },
    { path: "/register", name: "register", component: RegisterView },
    { path: "/login", name: "login", component: LoginView },
    {
      path: "/reset-password",
      name: "reset-password",
      component: RessetPasswordView,
      meta: { requiresAuth: true },
    },
    // 後々/profileにmeta: { requiresAuth: true },を追加する(ログインしていないと見れない)
    { path: "/profile/", name: "profile", component: ProfileView },
    {
      path: "/profile/edit",
      name: "profile/edit",
      component: ProfileEditView,
      meta: { requiresAuth: true },
    },
    { path: "/class", name: "class", component: ClassListView },
    {
      path: "/class/:lectureId/detail",
      name: "class/:lectureId/detail",
      component: ClassDetailView,
      props: true,
    },
    { path: "/class/post", name: "class/post", component: ClassPostView },
    {
      path: "/privacy-policy",
      name: "privacy-policy",
      component: PrivacyPolicyView,
    },
    { path: "/terms", name: "terms", component: TermsView },
    { path: "/contact", name: "contact", component: ContactView },
    { path: "/:catchAll(.*)", name: "not-found", component: NotFoundView },
    // 設定画面を追加する.
  ],
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
      next("/login");
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
createApp(App).use(vuetify).use(router).use(store).mount("#app");
