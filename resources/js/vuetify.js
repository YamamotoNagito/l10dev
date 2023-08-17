import { createVuetify } from 'vuetify'
import { aliases, fa } from 'vuetify/iconsets/fa'
import { mdi } from 'vuetify/iconsets/mdi'
import '@mdi/font/css/materialdesignicons.css'

export default createVuetify({
  icons: {
    iconfont: 'mdi',
    defaultSet: 'fa',
    aliases,
    sets: {
      fa,
      mdi,
    },
  },
})