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

const user_name = ref('');
const user_email = ref('');
const password = ref('');
// const university_name = ref('');
const category = ref('大学生');
const faculty = ref('情報科学部');
const department = ref('情報科学科');
const admission_year = ref(2023);

// 新規登録に関するapiを呼び出してくる 
// 書き方は,Login.vueを参照すること
const clickButton = async() => {
  console.log("クリックされたで");

  const data = {
    user_name:user_name.value,
    user_email:user_email.value,
    password:password.value,
    university_name:"広島大学",
    category:category.value,
    faculty:faculty.value,
    department:department.value,
    admission_year:admission_year.value,
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
    const response = await axios.post("/api/register", data);
    console.log("response")
    // console.log(response)
    // console.log(response.data.id)
    data['id'] = response.data.id;
    data['role'] = response.data.role;
    // console.log(data['role'])
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
                    v-model="user_name"
                    label="名前"
                    name="user_name"
                    type="name"
                    ></v-text-field>
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
                    <v-text-field
                    v-model="category"
                    label="所属"
                    name="category"
                    type="text"
                    ></v-text-field>
                    <v-text-field
                    v-model="faculty"
                    label="学部"
                    name="faculty"
                    type="text"
                    ></v-text-field>
                    <v-text-field
                    v-model="department"
                    label="学科"
                    name="department"
                    type="text"
                    ></v-text-field>
                    <v-text-field
                    v-model="admission_year"
                    label="入学年度"
                    name="admission_year"
                    type="number"
                    ></v-text-field>
                    <v-btn @click="clickButton">送信</v-btn>
                </v-form>
            </v-container>
        </v-main>
    </v-app>
</template>