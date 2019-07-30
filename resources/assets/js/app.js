require('./bootstrap');

import {Tabs, Tab} from 'vue-tabs-component';

window.Vue = require('vue');

const app = new Vue({
  el: '#app',

  components: {
    'tabs': Tabs,
    'tab': Tab,
  }
});
