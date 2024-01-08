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

const user_email = ref('');
const password = ref('');

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
    user_email:user_email.value,
    password:password.value
  }
  console.log(data)
  
  await axios.post("/api/login",data)
  .then((response) => {
    // ちゃんと送信できたか確認用
    console.log(response.data.success);
    if(response.data.success){
      // axios.get("/profile2");
      // const url = '/profile'
      // window.location.href = url
      store.dispatch('login', data);
      // store.dispatch('login', { user_email: data.user_email, password: data.password });
      // this.$store.dispatch('login', { user_email: data.user_email, password: data.password });
      router.push('/profile')
    }else{

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
//   user_email,
//   password
// }

</script>

<template>
  <h1>ログイン画面</h1>
    <!-- <form action="" method="post"> -->
      <!-- @csrf -->
      <!-- <div>
        <label for="user_email">メールアドレス</label>
        <v-input type="user_email" name="user_email" id="user_email"></v-input>
      </div>
      <label for="password">パスワード</label>
      <input type="password" name="password" id="password">
      <v-text-field type="password" name="password" id="password" label="パスワードを入力してください"></v-text-field>
      <v-btn type="submit">送信</v-btn> -->
      <v-form action="" method="post">
        <v-text-field
          v-model="user_email"
          label="メールアドレス"
          name="user_email"
          type="email"
        ></v-text-field>
        <v-text-field
          v-model="password"
          label="パスワード"
          name="password"
          type="password"
        ></v-text-field>
        <!-- <v-btn @click="clickButton">送信</v-btn> -->
        <Button @click="clickButton" title="送信"></Button>
      </v-form>

      <Button @click="clickLogoutButton" title="ログアウト"></Button>
      <!-- </form> -->
      <!-- <v-btn @click="clickButton">送信</v-btn> -->
</template>
