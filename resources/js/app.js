require('./bootstrap');

require('alpinejs');

import Vue from 'vue'
window.Vue = require('vue');

Vue.component('bid-countdown-timer', require('./components/BidCountdownTimer.vue').default);

const app = new Vue({
    el: '#app'
});
