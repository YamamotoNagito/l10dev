// store/index.js

import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
// export default new Vuex.Store({
  state: {
    isLoggedIn: false, // ログイン状態を保持する変数
    userInfo: null // ログインユーザーの情報を保持する変数
  },
  mutations: {
    // ログイン状態を変更するためのミューテーション
    setLoggedIn(state, isLoggedIn) {
      state.isLoggedIn = isLoggedIn;
    },
    // ログインユーザーの情報を設定するためのミューテーション
    setUserInfo(state, userInfo) {
      state.userInfo = userInfo;
    }
  },
  actions: {
    // ログイン処理
    login({ commit }, userCredentials) {
      // ログインの実際の処理をここに追加
      // ログイン成功時にはcommitを使用してミューテーションを呼び出し、ログイン情報を更新
      commit('setLoggedIn', true);
      commit('setUserInfo', userCredentials);
    },
    // ログアウト処理
    logout({ commit }) {
      // ログアウトの実際の処理をここに追加
      // ログアウト成功時にはcommitを使用してミューテーションを呼び出し、ログイン情報をリセット
      commit('setLoggedIn', false);
      commit('setUserInfo', null);
    }
  },
  modules: {}
})