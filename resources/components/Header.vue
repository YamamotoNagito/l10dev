<script setup>
import { ref } from 'vue'
import vuetify from '../js/vuetify';
import { mdiAccount } from '@mdi/js'
</script>
<template>
    <div>
        <v-app style="max-height: 64px;">
            <v-app-bar color="primary" app>
            <v-app-bar-nav-icon />
            <v-toolbar-title>かえで ~広大生の学びを支える情報サイト~</v-toolbar-title>
            <v-spacer />

             <!-- ホームアイコンを使用したい際には以下 
            <v-btn icon>
            <v-icon>mdi-home</v-icon>
            </v-btn> -->

            <v-btn href="login">
                ログイン
            </v-btn>
            <v-btn href="register">
                新規登録
            </v-btn>
            </v-app-bar>
        </v-app>
    </div>
  </template>
  
  <style>
  /* h1 {
    line-height: 48px;
    text-align: center;
  }
  
  h3 {
    text-align: center;
  }
  
  .header-content {
    display:flex;
    flex-wrap: wrap;
    width: 100%;
  }

  .header-title{
    text-align: center;
  }
  
  header {
    display: flex;
    justify-content: center;
    line-height: 1.5;
    max-height: 100vh;
  }
  
  .logo {
    display: block;
    margin: 0 auto 2rem;
  }
  
  nav {
    width: 100%;
    font-size: 12px;
    text-align: center;
    margin-top: 2rem;
  }
  
  nav a.router-link-exact-active {
    color: var(--color-text);
  }
  
  nav a.router-link-exact-active:hover {
    background-color: transparent;
  }
  
  nav a {
    display: inline-block;
    padding: 0 1rem;
    border-left: 1px solid var(--color-border);
  }
  
  nav a:first-of-type {
    border: 0;
  } */
  
  /* @media (min-width: 1024px) {
    header {
      display: flex;
      justify-content: center;
      padding-right: calc(var(--section-gap) / 2);
    }
  
    .logo {
      margin: 0 2rem 0 0;
    }
  
    header .wrapper {
      display: flex;
      place-items: flex-start;
      flex-wrap: wrap;
    }
  
    nav {
      text-align: left;
      font-size: 1rem;
  
      padding: 1rem 0;
      margin-top: 1rem;
    }
    
    h1 {
    line-height: 48px;
    text-align: center;
    }
  
  } */
  </style>
  