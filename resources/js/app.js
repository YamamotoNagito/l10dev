import { createApp } from 'vue/dist/vue.esm-bundler.js';
import App from '../components/App.vue'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
})

createApp({
    components: {
          App,
  },
})
.use(vuetify)
.mount("#app")