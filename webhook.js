#!/usr/bin/env node
var http = require('http');
var util = require('util');
var sys = require('sys');

var server = http.createServer(function (request, response) {
  console.log(util.inspect(request.url));
  if (request.url === "/765rvbk345678ihg97654etfgu8765edfghje5465788ioujhgfr6rytuyiujkhgf798ouyrettuyijkbt8675432qsdfghjbtuih") {
    response.writeHead(200, {'Content-Type': 'text/html'});
    response.end("ok");
    var exec = require('child_process').exec;
    exec("git pull", {cwd: '/var/www/wp-content/plugins/mashery-developer-portal'}, function puts(error, stdout, stderr) { sys.puts(stdout); });
  } else {
    response.writeHead(400);
  }
});
server.listen(8080);
