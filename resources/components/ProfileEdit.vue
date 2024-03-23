<script setup>
  import { ref } from "vue";
  import { onMounted } from "vue";
  import { useRoute, useRouter } from "vue-router";
  import { useStore } from "vuex";
  import axios from "axios";

  const store = useStore();
  const router = useRouter();
  
  // レビュー総数の取得(response.data：レビュー総数)
  onMounted(async () => {
    try {
      // 編集機能の作成
      const data = {
          userName: "intmain1@com",
          userEmail: "intmain1@com",
          password: "aaa",
          universityName: "広島大学",
          category: "その他",
          faculty: "その他",
          department: "その他",
          admissionYear: "その他"
      };
      
      await axios.post("/api/update",data);
      store.dispatch("login", data);
      router.push({ name: "profile" });

      } catch (error) {
        if (error?.response?.data) {
          // サーバーからのエラーレスポンスがある場合
          setErrorMessage(error.response.data.message);
        } else {
          setErrorMessage(
            "登録できませんでした. サーバーのエラー, または既に使用されているメールアドレスである可能性があります. "
          );
        }
      }
  });

  const message = ref("Hello World!");


</script>

<template>
  <h1>おはよう</h1>
</template>
