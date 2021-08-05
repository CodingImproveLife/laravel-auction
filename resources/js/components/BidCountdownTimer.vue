<template>
    <div class="flex flex-row">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-4 mr-1"
            viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                  clip-rule="evenodd"/>
        </svg>
        <div v-if="sale">{{ hours }}:{{ minutes }}:{{ seconds }}</div>
        <div v-else>Sold</div>
    </div>
</template>

<script>
export default {
    props: ['saleTimestamp'],
    mounted() {
        this.setLotEndTime()
        setInterval(() => {
            this.setLotEndTime()
        }, 1000)
    },
    data() {
        return {
            time: this.saleTimestamp - Math.round(Date.now() / 1000),
            sale: true
        }
    },
    methods: {
        setLotEndTime() {
            if (this.time > 0) {
                this.time = this.saleTimestamp - Math.round(Date.now() / 1000);
            } else {
                this.sale = false;
            }
        }
    },
    computed: {
        hours() {
            return Math.floor((this.time / (60 * 60)) % 24)
        },
        minutes() {
            return Math.floor((this.time / 60) % 60)
        },
        seconds() {
            return Math.floor((this.time) % 60)
        }
    }
}
</script>
