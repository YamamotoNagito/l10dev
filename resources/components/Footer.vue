<template>
    <!-- <v-app> -->
      <v-footer class="bg-grey-lighten-1" app absolute>
        <v-row no-gutters>
          <v-col cols="0" sm="0" md="2" lg="2" xl="2"></v-col>
          <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center" >
            <v-btn
              href="/about-us"
              variant="text"
              rounded="xl" >
              Developed by SOS団
            </v-btn>
          </v-col>
          <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center" >
            <v-btn
              href="/terms"
              variant="text"
              rounded="xl" >
              利用規約
            </v-btn>
          </v-col>
          <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center" >
            <v-btn
              href="/privacy-policy"
              variant="text"
              rounded="xl" >
              プライバシーポリシー
            </v-btn>
          </v-col>
          <v-col cols="6" sm="3" md="2" lg="2" xl="2" class="d-flex justify-center" >
            <v-btn
              href="/contact"
              variant="text"
              rounded="xl" >
              お問い合わせ
            </v-btn>
          </v-col>
          <v-col cols="0" sm="0" md="2" lg="2" xl="2"></v-col>
            <v-col class="text-center mt-4" cols="12">
              {{ new Date().getFullYear() }} — かえで
            </v-col>
        </v-row>
      </v-footer>
    <!-- </v-app> -->
</template>

<style>
</style>
