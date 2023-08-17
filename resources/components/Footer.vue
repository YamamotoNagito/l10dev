<template>
    <footer>
      <div class="wrapper">
          <nav>
            Developed by SOS団
            <a href="/TermsOfService">利用規約</a>
            <a href="/Contact">問い合わせ</a>
          </nav>
      </div>

      <!-- <v-app dark>
            <v-app-bar dark>
            <v-app-bar-nav-icon />
            <v-toolbar-title>かえで ~広大生の学びを支える情報サイト~</v-toolbar-title>
            <v-spacer />

            ホームアイコンを使用したい際には以下
            <v-btn icon>
            <v-icon>mdi-home</v-icon>
            </v-btn>

            <v-btn href="login">
                ログイン
            </v-btn>
            <v-btn href="register">
                新規登録
            </v-btn>
            </v-app-bar>
        </v-app> -->
    </footer>
  </template>
  
  <style>
  /* footer {
    display: flex;
    justify-content: center;
    line-height: 1.5;
  } */
  footer {
    left: 0;
    width: 100%;
    background-color: white;
  }
  
  .wrapper {
    width: 100%;
    display: flex;
    justify-content: center;
    line-height: 1.5;
    /* max-height: 100vh; */
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
  }
  
  @media (min-width: 1024px) {
    /* footer {
      display: flex;
      justify-content: center;
      padding-right: calc(var(--section-gap) / 2);
    } */
    
    .wrapper {
    width: 100%;
    display: flex;
    justify-content: center;
    line-height: 1.5;
    max-height: 100vh;
    }
  
    nav {
      text-align: center;
      /* margin-left: -1rem; */
      font-size: 1rem;
  
      padding: 1rem 0;
      margin-top: 1rem;
    }
  }
  </style>
  