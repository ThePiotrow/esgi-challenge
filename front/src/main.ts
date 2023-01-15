import { createApp } from 'vue'
import './style.css'
import App from './App.vue'

import { createPinia } from "pinia"
import router from './router'
// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
});

createApp(App).use(vuetify).use(createPinia()).use(router).mount('#app')
