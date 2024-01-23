<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import Header from './Header.vue'
import Footer from './Footer.vue'
import axios from 'axios';
import { jsx } from 'vue/jsx-runtime';
import { useRouter } from 'vue-router';
import Button from './Button.vue';
import { useStore } from 'vuex';

const router = useRouter()
const store = useStore()

const userEmail = ref('');
const password = ref('');

const errorMessage = ref(''); // エラーメッセージ用の変数

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

const clickButton = async() => {

  // const store = useStore()
  console.log("クリックされたで");
  // console.log("クリックされたで2");
  // const res = await axios.get("/register");
  // const res = await axios.get("/api/hello");
  // console.log(res);
  
  const data = {
    userEmail:userEmail.value,
    password:password.value
  }
  console.log(data)
  
  await axios.post("/api/login",data)
  .then((response) => {
    // ちゃんと送信できたか確認用
    console.log(response.data.success);
    if(response.data.success){
      
      data['id'] = response.data.id;
      data['role'] = response.data.role;
      // console.log(response)
      // console.log(response.data.role)
      // console.log(data['role'])
      console.log(data)
      store.dispatch('login', data);
      router.push('/profile')
    }else{
      //ログインに失敗したときのエラーメッセージ
      errorMessage.value = 'ログインできませんでした。メールアドレスまたはパスワードを確認してください。';
    }
    // console.log("OK");
    // axios.get("/profile")
    })
    .catch((err) => {
      console.log(err);
      // console.log("×");
  });
};

// return{
//   userEmail,
//   password
// }

</script>

<template>
  <h1>ログイン画面</h1>
    <!-- <form action="" method="post"> -->
      <!-- @csrf -->
      <!-- <div>
        <label for="userEmail">メールアドレス</label>
        <v-input type="userEmail" name="userEmail" id="userEmail"></v-input>
      </div>
      <label for="password">パスワード</label>
      <input type="password" name="password" id="password">
      <v-text-field type="password" name="password" id="password" label="パスワードを入力してください"></v-text-field>
      <v-btn type="submit">送信</v-btn> -->
      <v-form action="" method="post">
        <v-text-field
          v-model="userEmail"
          label="メールアドレス"
          name="userEmail"
          type="email"
          clearable
        ></v-text-field>
        <v-text-field
          v-model="password"
          label="パスワード"
          name="password"
          type="password"
          clearable
        ></v-text-field>
        <!-- <v-btn @click="clickButton">送信</v-btn> -->
        <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
        <Button @click="clickButton" title="送信"></Button>
      </v-form>

      <!-- <Button @click="clickLogoutButton" title="ログアウト"></Button> -->
      <!-- </form> -->
      <!-- <v-btn @click="clickButton">送信</v-btn> -->

      <!-- 新規登録画面への遷移 -->
      <Button @click="router.push({ name: 'register'})" title="アカウントを持っていない方はこちら"></Button>
</template>

<style scoped>
  .error-message {
    color: red;
    font-weight: bold;
  }
</style>