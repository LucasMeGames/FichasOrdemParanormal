var express = require('express'),
    app = express(),
    cookieParser = require('cookie-parser'),
    session = require('express-session'),
    RedisStore = require('connect-redis')(session);

app.use(express.static(__dirname + '/public'));
app.use(function(req, res, next) {
    if (~req.url.indexOf('favicon'))
        return res.send(404);
    next();
});
app.use(cookieParser());
app.use(session({
    store: new RedisStore({
        // this is the default prefix used by redis-session-php
        prefix: 'session:php:'
    }),
    // use the default PHP session cookie name
    name: 'PHPSESSID',
    secret: 'myballs',
    resave: false,
    saveUninitialized: false
}));
app.use(function(req, res, next) {
    req.session.nodejs = 'Hello from node.js!';
    res.send('<pre>' + JSON.stringify(req.session, null, '    ') + '</pre>');
});

app.listen(8080);