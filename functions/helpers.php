<?php

//config

define('BACE_URL', 'http://localhost/php-project/');

function redirect($url){
    header('Location: '. trim(BACE_URL, '/ ') . '/' . trim($url, '/ '));
    exit;
};

function asset($file){
    return trim(BACE_URL, '/ ') . '/' . trim($file, '/ ');
};

function url($url){
    return trim(BACE_URL, '/ ') . '/' . trim($url, '/ ');
};

function dd($var){
    echo '<pre>';
    var_dump($var);
    exit;
}
