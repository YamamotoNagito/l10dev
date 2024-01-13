<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import axios from 'axios';


// import { mdiAccount, mdiLogout } from '@mdi/js';

// ドロワーの開閉状態を管理する変数
const drawer = ref(false);

const router = useRouter()
const store = useStore()

const email = ref('');
const password = ref('');

// $userId  = store.getters.userInfo.id,
const clickProfileButton = async () => {
  console.log("クリックされたで");
  console.log(store.getters.userInfo.id);

  const data = {
    user_id: store.getters.userInfo.id,
  }
  
  try {
    const response = await axios.post("/api/reviews", data);
    console.log("response");

    if(response.data.success){
      router.push('/reviews');
    }else{
      console.log(response.data.message);
      message.value = response.data.message;
    }


  // その他の処理
  } catch (error) {
    if (error.response) {
      // サーバーからのエラーレスポンスがある場合
      console.error(error.response.data); // エラーレスポンスをコンソールに出力
    } else {
      // リクエストがサーバーに届かなかった場合など
      console.error(error.message);
    }
  }
}

const clickLogoutButton = async() => {
  await axios.post("/api/logout")
  .then((response) => {
    // ちゃんと送信できたか確認用
    // console.log(response.data.success);
    // if(response.data.success){
      // }
      store.dispatch('logout');
      router.push('/profile')
  })
  .catch((err) => {
    console.log(err);
  });
}


// ログアウトの処理


</script>
<template>
    <div>
        <v-app style="max-height: 64px;">
            <v-app-bar color="orange" hide-on-scroll>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"/>
            <v-toolbar-title>
              かえで ~広大生の学びを支える情報サイト~
            </v-toolbar-title>
            <v-spacer />

            <v-btn href="login">
              <v-icon>mdi-login</v-icon>
                ログイン
            </v-btn>
            </v-app-bar>

            <!-- ハンバーガーメニューの中身（サイドバー） -->
            <v-navigation-drawer
             v-model="drawer"
              temporary >

              <v-list nav>
                <v-list-item>
                  <v-btn block variant="text" @click="clickProfileButton">
                    <v-icon>mdi-account</v-icon>
                    プロフィール
                  </v-btn>
                </v-list-item>
                <v-list-item>
                  <v-btn block variant="text" color="red" @click="clickLogoutButton">
                    <v-icon>mdi-logout</v-icon>
                      ログアウト
                  </v-btn>
                </v-list-item>
              </v-list>
            </v-navigation-drawer>
        </v-app>
    </div>
  </template>

  <style>
  /* h1 {
    line-height: 48px;
    text-align: center;
  }

  h3 {
    text-align: center;
  }

  .header-content {
    display:flex;
    flex-wrap: wrap;
    width: 100%;
  }

  .header-title{
    text-align: center;
  }

  header {
    display: flex;
    justify-content: center;
    line-height: 1.5;
    max-height: 100vh;
  }

  .logo {
    display: block;
    margin: 0 auto 2rem;
  }

  nav {
    width: 100%;
    font-size: 12px;
    text-align: center;
    margin-top: 2rem;
  }

  nav a.router-link-exact-active {
    color: var(--color-text);
  }

  nav a.router-link-exact-active:hover {
    background-color: transparent;
  }

  nav a {
    display: inline-block;
    padding: 0 1rem;
    border-left: 1px solid var(--color-border);
  }

  nav a:first-of-type {
    border: 0;
  } */

  /* @media (min-width: 1024px) {
    header {
      display: flex;
      justify-content: center;
      padding-right: calc(var(--section-gap) / 2);
    }

    .logo {
      margin: 0 2rem 0 0;
    }

    header .wrapper {
      display: flex;
      place-items: flex-start;
      flex-wrap: wrap;
    }

    nav {
      text-align: left;
      font-size: 1rem;

      padding: 1rem 0;
      margin-top: 1rem;
    }

    h1 {
    line-height: 48px;
    text-align: center;
    }

  } */
  </style>
