<script setup>
import { ref } from 'vue';
import vuetify from '../js/vuetify';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useVuelidate } from '@vuelidate/core';
import { required, email, maxLength } from '@vuelidate/validators';


const router = useRouter();

const name = ref('');
const emailInputed = ref('');
const message = ref('');
const category = ref(null);

const category_items = ref(['投稿報酬の請求', '利用規約・プライバシーポリシーに関する問い合わせ', '操作方法に関する問い合わせ', '退会したい', 'バグ報告', '欲しい機能・情報など', 'その他']);

const rules = {
  name: { required, maxLength: maxLength(32) },
  emailInputed: { required, email },
  message: { required, maxLength: maxLength(2000) },
  category: { required },
};

const v$ = useVuelidate(rules, { name, emailInputed, message, category });

// 送信後、フォームのカテゴリとメッセージをリセットする
const resetForm = () => {
  category.value = '';
  message.value = '';
  v$.value.$reset(); // バリデーション状態のリセット
};

const clickButton = async() => {
  // console.log("クリックされたで");

  v$.value.$validate();
  if (!v$.value.$invalid) {
    // バリデーション成功時の処理
    // console.log('バリデーション成功！');

    const data = {
      name:name.value,
      email:emailInputed.value,
      category:category.value,
      message:message.value,
    }
 
    try {
      console.log('postするdata: ', data);
      await axios.post("/api/contact", data);

      alert('お問い合わせ内容を送信しました. ');
      // フォームをリセットする
      resetForm();

    // その他の処理
    } catch (error) {
      if (error.response) {
        // サーバーからのエラーレスポンスがある場合
        console.error('エラーレスポンス：', error.response.data); // エラーレスポンスをコンソールに出力
        
      } else {
        // リクエストがサーバーに届かなかった場合など
        console.error('エラーメッセージ：', error.message);
        // errorMessage.value = 'エラー：何らかの原因によりお問い合わせ内容を送信できませんでした. 復旧までの間, お問い合わせをする場合は tarouhirodai@gmail.com までご連絡ください. ';
        alert('エラー：何らかの原因によりお問い合わせ内容を送信できませんでした. 復旧までの間, お問い合わせをする場合は tarouhirodai@gmail.com までご連絡ください. ');
      }
    }
  }

};
</script>

<template>
  <v-app>
      <v-main>
        <v-container>
            <!-- <p class="text-h6 text-md-h4 text-lg-h3">お問い合わせ</p> -->
            <br/>
            <p class="text-h6 text-md-h5 text-lg-h4">ユーザ情報</p>
            <v-text-field
              v-model="name"
              :error-messages="v$.name.$error ? ['1字以上32字以下の, 氏名を入力してください. '] : []"
              label="氏名"
              placeholder="広島 かえで"
              hide-details="auto"
              clearable
            ></v-text-field>
            <v-text-field
              v-model="emailInputed"
              :error-messages="v$.emailInputed.$error ? ['有効なメールアドレスを入力してください. '] : []"
              label="メールアドレス"
              placeholder="Kaede@gmail.com"
              type="email"
              clearable
            ></v-text-field>
            <p class="text-h6 text-md-h5 text-lg-h4">カテゴリ</p>
            <v-select
                v-model="category"
                :error-messages="v$.category.$error ? ['お問い合わせの種類を選択してください. 当てはまるものが無ければ「その他」を選択してください. '] : []"
                :items="category_items"
                label="お問い合わせ内容に最も合うものを選んでください. "
                clearable
            ></v-select>
            <p class="text-h6 text-md-h5 text-lg-h4">お問い合わせ内容</p>
            <v-textarea
              v-model="message"
              :error-messages="v$.message.$error ? ['2000文字以内で, お問い合わせ内容を入力してください. '] : []"
              name="input-7-1"
              filled
              label="お問い合わせ内容を記述してください. "
              auto-grow
              clearable
            ></v-textarea>
            <!-- <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p> -->
            <v-btn @click="clickButton" color="indigo">送信する</v-btn>
        </v-container>
      </v-main>
  </v-app>
</template>

<style scoped>
  .error-message {
    color: red;
    font-weight: bold;
  }
</style>