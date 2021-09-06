<template>
    <div>
        <div v-for="purchase in purchases" class="my-4">
            <span>{{ purchase.lot.name }}</span>
            <span>${{ purchase.price }}</span>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            purchases: []
        }
    },
    mounted() {
        axios.get('purchases')
            .then(response => {
                this.purchases = response.data
            })
            .catch(error => {
                console.log(error)
            })
    }
}
</script>
