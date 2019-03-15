<?php

require 'vendor/autoload.php';

$app = new Slim\App();

$app->get('/', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
	$plain = file_get_contents('node.txt');
	$ssr = collect(explode(PHP_EOL,$plain))->filter(function($line){
	    return \Illuminate\Support\Str::contains($line,"ssr://");
    });
    return $response->getBody()->write(base64_encode(implode(PHP_EOL,$ssr->all())));
});

$app->get('/add', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    $ssr = $request->getParam('node');
    file_put_contents('node.txt',$ssr.PHP_EOL,FILE_APPEND);
    return $response->getBody()->write('done !');
});

$app->get('/sub', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    $client = new GuzzleHttp\Client(['verify'=>false]);
    $link = $request->getParam('link');
    $plain = base64_decode($client->get($link)->getBody());
    file_put_contents('node.txt',PHP_EOL."## {$link} ".PHP_EOL,FILE_APPEND);
    file_put_contents('node.txt',$plain.PHP_EOL,FILE_APPEND);
    return $response->getBody()->write('done !');
});

$app->run();
