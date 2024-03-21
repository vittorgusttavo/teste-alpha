<?php

return [
    'GET' => [
        '/' => 'ProdutosController@index',
        '/index' => 'ProdutosController@index',
        '/add' => 'ModalsController@include',
        '/del' => 'ModalsController@delete',
        '/edit' => 'ModalsController@update',
        '/search' => 'ModalsController@search',
    ],
    'POST' => [
        '/' => 'ProdutosController@index',
        '/index' => 'ProdutosController@index',
        '/add' => 'ProdutosController@include',
        '/del' => 'ProdutosController@delete',
        '/edit' => 'ProdutosController@update',
        '/search' => 'ProdutosController@search',
    ],
];