require('./bootstrap');
require('./ckeditor');

require('alpinejs');

import Vue from 'vue'
window.Vue = require('vue');
window.io = require("socket.io-client");

Vue.component('bid-countdown-timer', require('./components/BidCountdownTimer.vue').default);
Vue.component('new-bid', require('./components/NewBid.vue').default);
Vue.component('unique-bids', require('./components/UniqueBids').default);
Vue.component('lot-status-badge', require('./components/LotStatusBadge').default);
Vue.component('user-purchases', require('./components/UserPurchases').default);

const app = new Vue({
    el: '#app'
});
