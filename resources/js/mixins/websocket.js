export default {
    data() {
        return {
            socket: io(process.env.MIX_APP_URL + ':' + process.env.MIX_NODE_PORT),
            event: "Bid:NewBid"
        }
    }
}
