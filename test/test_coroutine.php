<?php

// auto load
require '../vendor/autoload.php';

// opt
$option = array(
  'base_uri' => "https://us12.api.mailchimp.com/3.0/",
  'auth' => ['apikey', '292bae37c631ac3ba03ed0640b44e6c3'],
);

// client
$client = new \GuzzleHttp\Client($option);

// The decoded JSON from the second query here.
$response2 = coroutine(function () use ($client) {
  // create a list
  $url_display_list = 'lists';
  $req_create_list = new Request('POST', $url_display_list, $headers, json_encode($data_list));
  $response1 = (yield $client->sendAsync('POST', $url1));

  // Do something with the first response and prepare the second query.

  $response2 = (yield $client->sendAsync('POST', $url2));
  // Decode JSON and/or do other stuff with the final results.

  // The final return value of the coroutine.
  yield json_decode($response2->getBody()->getContents(), true);
});
