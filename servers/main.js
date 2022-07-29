const { Server } = require("socket.io");
const io = new Server();


function getUrlVars(url) {
    var hash;
    var myJson = {};
    var hashes = url.slice(url.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        myJson[hash[0]] = hash[1];
    }
    return myJson;
}




io.sockets.on('connection', function(socket) {

    socket.on('create', function(room) {

        console.log(socket.handshake.headers.referer);

        let idficha = getUrlVars(socket.handshake.headers.referer);


        if(idficha.token === room){
            socket.join(room);console.log('connected to: ' + room);
            socket.on(room, (msg) => {
                io.emit(room, msg);
            });
        } else {
            console.log(idficha.token + " =/= " + room + " From URL: " + socket.handshake.headers.referer);
            socket.disconnect();
        }
        socket.on('disconnect', () => {
            console.log('disconnected from: ' + room);
        });
    });
});
io.listen(3000, () => {
    console.log('listening on *:3000');
});