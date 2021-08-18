<template>
    <span>{{ uniqueBids + declension() }}</span>
</template>

<script>

import websocket from "../mixins/websocket";

export default {
    props: ['lot', 'bid', 'unique'],
    mixins: [websocket],
    data() {
        return {
            maxBid: this.bid,
            lotId: this.lot,
            uniqueBids: this.unique,
        }
    },
    methods: {
        declension() {
            return this.uniqueBids === 1 ? ' bid' : ' bids'
        }
    },
    created() {
        this.socket.on(this.event, (message) => {
            if (message.lot_id === this.lotId) {
                this.uniqueBids = message.unique_bids
            }
        })
    }
}
</script>
