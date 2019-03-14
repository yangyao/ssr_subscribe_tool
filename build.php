<?php
require 'vendor/autoload.php';

$plain = file_get_contents('node.txt');
$ssr = collect(explode(PHP_EOL,$plain))->filter(function($line){
    return \Illuminate\Support\Str::contains($line,"ssr://");
});
return file_put_contents('dist/index.html',base64_encode($ssr));