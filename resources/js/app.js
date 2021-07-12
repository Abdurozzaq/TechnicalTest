import Vue from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue'

import { InertiaProgress } from '@inertiajs/progress'

// vuetify plugin 
import vuetify from './plugin/vuetify.js'

InertiaProgress.init()

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, app, props }) {
    new Vue({
      vuetify,
      render: h => h(app, props),
    }).$mount(el)
  },
})