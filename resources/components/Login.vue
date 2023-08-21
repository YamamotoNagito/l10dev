<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import Header from './Header.vue'
import Footer from './Footer.vue'
import axios from 'axios';
import { jsx } from 'vue/jsx-runtime';
import { useRouter } from 'vue-router'

const router = useRouter()

const email = ref('');
const password = ref('');

const clickButton = async() => {
  console.log("クリックされたで");
  // console.log("クリックされたで2");
  // const res = await axios.get("/register");
  // const res = await axios.get("/api/hello");
  // console.log(res);
  
  const data = {
    email:email.value,
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
//   email,
//   password
// }

</script>

<template>
  <h1>ログイン画面</h1>
    <!-- <form action="" method="post"> -->
      <!-- @csrf -->
      <!-- <div>
        <label for="email">メールアドレス</label>
        <v-input type="email" name="email" id="email"></v-input>
      </div>
      <label for="password">パスワード</label>
      <input type="password" name="password" id="password">
      <v-text-field type="password" name="password" id="password" label="パスワードを入力してください"></v-text-field>
      <v-btn type="submit">送信</v-btn> -->
      <v-form action="" method="post">
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
      <!-- </form> -->
      <!-- <v-btn @click="clickButton">送信</v-btn> -->
</template>
