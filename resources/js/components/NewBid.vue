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
            socket: io('http://localhost:5555'),
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
