<template>
    <div>
        <div v-for="purchase in purchases.data" class="my-4">
            <span>{{ purchase.lot.name }}</span>
            <span>${{ purchase.price }}</span>
        </div>
        <div class="flex">
            <div v-if="purchases.current_page !== 1">
                <button v-on:click="getPurchases(purchases.current_page - 1)"
                        class="inline-flex items-center justify-center w-10 h-10 mr-2 text-gray-300 transition-colors duration-150 border border-gray-300 rounded-lg focus:shadow-outline hover:bg-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            <div v-if="purchases.current_page !== purchases.last_page">
                <button v-on:click="getPurchases(purchases.current_page + 1)"
                        class="inline-flex items-center justify-center w-10 h-10 text-gray-300 transition-colors duration-150 border border-gray-300 rounded-lg focus:shadow-outline hover:bg-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            purchases: {},
        }
    },
    mounted() {
        this.getPurchases();
    },
    methods: {
        getPurchases(page = 1) {
            axios.get('purchases?page=' + page)
                .then(response => {
                    this.purchases = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>
