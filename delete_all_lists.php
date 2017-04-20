<?php

// auto load
require 'vendor/autoload.php';

use GuzzleHttp\Psr7\Request;

// opt
$option = array(
  'base_uri' => "https://us12.api.mailchimp.com/3.0/",
  'auth' => ['apikey', 'a8bea4b3f923e0feb0596cae68163ea6'], // old key disabled
);

// client
$client = new \GuzzleHttp\Client($option);

// common
$headers = array(
  'User-Agent' => 'testing/1.0',
  'Accept'     => 'application/json'
);


// ------------- Get all lists -------------------
$url_get_list = 'lists';
$req_list = new Request('GET', $url_get_list, $headers);

// promise
$promise_get_all_list = $client
  ->sendAsync($req_list)
  ->then(function ($res) use ($headers, $client) {
    $obj = json_decode($res->getBody());
    //print_r($obj->lists);
    foreach($obj->lists as $list) {
      $list_id = $list->id;

      // ----------- delete a list -------------
      $url_delete_list = 'lists/'. $list_id;
      $req_delete_list = new Request('DELETE', $url_delete_list, $headers);
      $promise_delete_list = $client
        ->sendAsync($req_delete_list)
        ->then(function ($res) use ($list_id) {
          echo "\n---- Delete list: ". $list_id. "----\n";
          print_r($res);
        });
      // wait
      $promise_delete_list->wait();
    }
  });

// wait
$promise_get_all_list->wait();
