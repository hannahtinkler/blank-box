require('./bootstrap');

import {Tabs, Tab} from 'vue-tabs-component';
import ForgeSites from './components/ForgeSites';

window.Vue = require('vue');

const app = new Vue({
  el: '#app',

  components: {
    'tabs': Tabs,
    'tab': Tab,
    'forge-sites': ForgeSites,
  }
});
