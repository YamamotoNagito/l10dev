<template>
    <v-app>
      <v-footer class="bg-grey-lighten-1" app absolute>
        <v-row justify="center" no-gutters>
          <v-btn
            href="/about-us"
            variant="text"
            rounded="xl" >
            Developed by SOS団
          </v-btn>
          <v-btn
            href="/privacy-policy"
            variant="text"
            rounded="xl" >
            プライバシーポリシー
          </v-btn>
          <v-btn
            href="/terms"
            variant="text"
            rounded="xl" >
            利用規約
          </v-btn>
          <v-btn
            href="/contact"
            variant="text"
            rounded="xl" >
            お問い合わせ
          </v-btn>
          <v-col class="text-center mt-4" cols="12">
            {{ new Date().getFullYear() }} — かえで
          </v-col>
        </v-row>
      </v-footer>
    </v-app>
</template>

<style>
</style>
