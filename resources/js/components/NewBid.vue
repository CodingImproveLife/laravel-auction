<template>
    <span>
         ${{ maxBid }}
    </span>
</template>

<script>
export default {
    props: ['lot', 'bid'],
    data() {
        return {
            socket: io(process.env.MIX_APP_URL + ':' + process.env.MIX_NODE_PORT),
            maxBid: this.bid,
            lotId: this.lot,
        }
    },
    created() {
        this.socket.on("Bid:NewBid", (message) => {
            if (message.lot_id === this.lotId) {
                this.maxBid = message.bid_price
            }
        });
    },
}
</script>
