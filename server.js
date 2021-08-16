const http = require('http').Server();
const ioRedis = require('ioredis');
const redis = new ioRedis();

require('dotenv').config();

const io = require("socket.io")(http, {
    cors: {
        origin: process.env.APP_URL,
        credentials: true,
        methods: ["GET"]
    }
});

redis.subscribe('Bid');

redis.on('message', function (channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

http.listen(process.env.MIX_NODE_PORT, function () {
    console.log('Server start on ' + process.env.MIX_NODE_PORT);
});
