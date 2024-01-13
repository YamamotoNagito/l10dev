<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import axios from 'axios';
import { useRouter } from 'vue-router'

const router = useRouter();

const name = ref('');
const email = ref('');
const message = ref('');

const category_items = ref(['退会したい', 'バグ報告', 'その他']);
const category = ref(null);

const clickButton = async() => {
  console.log("クリックされたで");

  const data = {
    name:name.value,
    email:email.value,
    category:category.value,
    message:message.value,
  }

try {
    await axios.post("/api/contact", data);
    router.push('/contact');

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
            <p class="text-h6 text-md-h4 text-lg-h3">お問い合わせ</p>
            <br/>
            <p class="text-h6 text-md-h5 text-lg-h4">ユーザ情報</p>
            <v-text-field
              v-model="name"
              label="氏名"
              placeholder="広島 かえで"
              hide-details="auto"
            ></v-text-field>
            <v-text-field
              v-model="email"
              label="メールアドレス"
              placeholder="Kaede@gmail.com"
              type="email"
            ></v-text-field>
            <p class="text-h6 text-md-h5 text-lg-h4">カテゴリ</p>
            <v-combobox
                v-model="category"
                :items="category_items"
                label="お問い合わせ内容に最も合うものを選んでください. "
                clearable
            ></v-combobox>
            <p class="text-h6 text-md-h5 text-lg-h4">お問い合わせ内容</p>
            <v-container fluid>
                <v-textarea
                v-model="message"
                name="input-7-1"
                filled
                label="こちらにお問い合わせ内容を記述してください. "
                auto-grow
                ></v-textarea>
            </v-container>
            <v-btn @click="clickButton" color="indigo">送信する</v-btn>


        </v-container>
      </v-main>
  </v-app>
</template>
