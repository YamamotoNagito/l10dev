<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import axios from 'axios';
import { useRouter } from 'vue-router'

</script>

<template>
  <v-app>
      <v-main>
        <v-container>
            <p class="text-h6 text-md-h4 text-lg-h3">お問い合わせ</p>
            <br/>
            <p class="text-h6 text-md-h5 text-lg-h4">ユーザ情報</p>
            <v-text-field
              label="氏名"
              placeholder="広島 かえで"
              hide-details="auto"
            ></v-text-field>
            <v-text-field
              label="メールアドレス"
              placeholder="Kaede@gmail.com"
              type="email"
            ></v-text-field>
            <p class="text-h6 text-md-h5 text-lg-h4">カテゴリ</p>
            <v-combobox
                v-model="select"
                :items="category_items"
                label="お問い合わせ内容に最も合うものを選んでください. "
                clearable
            ></v-combobox>
            <p class="text-h6 text-md-h5 text-lg-h4">お問い合わせ内容</p>
            <v-container fluid>
                <v-textarea
                name="input-7-1"
                filled
                label="こちらにお問い合わせ内容を記述してください. "
                auto-grow
                ></v-textarea>
            </v-container>
            <v-btn color="indigo">送信する</v-btn>


        </v-container>
      </v-main>
  </v-app>
</template>
<script>
  export default {
    data () {
      return {
        select: [],
        category_items: [
          '選択肢１',
          '選択肢２',
          '選択肢３',
          'その他',
        ],
      }
    },
  }
</script>