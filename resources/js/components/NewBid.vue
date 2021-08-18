<template>
    <span>
         ${{ maxBid }}
    </span>
</template>

<script>

import websocket from "../mixins/websocket";

export default {
    props: ['lot', 'bid'],
    mixins: [websocket],
    data() {
        return {
            maxBid: this.bid,
            lotId: this.lot,
        }
    },
    created() {
        this.socket.on(this.event, (message) => {
            if (message.lot_id === this.lotId) {
                this.maxBid = message.bid_price
            }
        });
    },
}
</script>
