const http = require('http').Server();
const ioRedis = require('ioredis');
const redis = new ioRedis();

const io = require("socket.io")(http, {
    cors: {
        origin: 'http://localhost',
        credentials: true,
        methods: ["GET"]
    }
});

redis.subscribe('Bid');

redis.on('message', function (channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

http.listen(5555, function () {
    console.log('Server start on 5555');
});
