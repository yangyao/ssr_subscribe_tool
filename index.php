<?php

require 'vendor/autoload.php';

$app = new Slim\App();

$app->get('/', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
	$plain = file_get_contents('node.txt');
	$ssr = collect(explode(PHP_EOL,$plain))->filter(function($line){
	    return \Illuminate\Support\Str::contains($line,"ssr://");
    });
    return $response->getBody()->write(base64_encode($ssr));
});

$app->get('/add', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    $ssr = $request->getParam('node');
    file_put_contents('node.txt',$ssr.PHP_EOL,FILE_APPEND);
    return $response->getBody()->write('done !');
});

$app->run();
