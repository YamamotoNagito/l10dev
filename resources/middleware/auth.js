// ページ遷移の認可
export default ({ store, route, redirect }) => {
    console.log("ログインのミドルウェア")
    if (!store.getters.isLoggedIn) {
        redirect('/login')
    }else{
        redirect('/profile')
    }    // if (!store.getters.isAuthenticated) {
    //   // 未認証の場合
    //   if (route.name !== 'login' && route.name !== 'register') {
    //     redirect('/login')
    //   }
    // } else if (route.name === 'login' || route.name === 'register') {
    //   // 認証済み，login or registerの場合
    //   redirect('/')
    // } else if (route.name.indexOf('manager') === 0) {
    //   // 認証済み
    //   if (!store.getters.idTokenResult.claims.teacher && !store.getters.idTokenResult.claims.administrator) {
    //     redirect('/')
    //   }
    // } else if (route.name.indexOf('admin') === 0) {
    //   // 認証済み
    //   if (!store.getters.idTokenResult.claims.administrator) {
    //     redirect('/')
    //   }
    // }
  }
  