<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import Header from './Header.vue'
import Footer from './Footer.vue'
import axios from 'axios';
import { jsx } from 'vue/jsx-runtime';
import { useRouter } from 'vue-router'
import { useStore } from 'vuex';

const router = useRouter();
const store = useStore();

const name = ref('');
const email = ref('');
const password = ref('');

// 新規登録に関するapiを呼び出してくる 
// 書き方は,Login.vueを参照すること
const clickButton = async() => {
  console.log("クリックされたで");

  const data = {
    name:name.value,
    email:email.value,
    password:password.value
  }

//   await axios.post("/api/register", data)
//   .then((response) => {
//     // ちゃんと送信できたか確認用
//     // console.log(response.data.success);
//     // if(response.data.success){
//       // } 
    //   store.dispatch('login', data);
//       router.push('/profile')
//   })
//   .catch((err) => {
//     console.log(err);
//   });  
try {
    await axios.post("/api/register", data);
    store.dispatch('login', data);
    router.push('/profile')

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
};

</script>

<template>
    <v-app>
        <v-main>
            <v-container>
                <h1 style="font-size: 2rem;">登録画面</h1>
                <v-form action="" method="post">
                    <v-text-field
                    v-model="name"
                    label="名前"
                    name="name"
                    type="name"
                    ></v-text-field>
                    <v-text-field
                    v-model="email"
                    label="メールアドレス"
                    name="email"
                    type="email"
                    ></v-text-field>
                    <v-text-field
                    v-model="password"
                    label="パスワード"
                    name="password"
                    type="password"
                    ></v-text-field>
                    <v-btn @click="clickButton">送信</v-btn>
                </v-form>
            </v-container>
        </v-main>
    </v-app>
</template>