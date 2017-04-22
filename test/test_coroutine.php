<?php

// auto load
require '../vendor/autoload.php';

// opt
$option = array(
  'base_uri' => "https://us12.api.mailchimp.com/3.0/",
  'auth' => ['apikey', 'a8bea4b3f923e0feb0596cae68163ea6'],
);

// client
$client = new \GuzzleHttp\Client($option);

// data
$data_list = array(
  "name" => "test_mailchimp",
  "contact" => array(
    "company" => "MailChimp",
    "address1" => "675 Ponce De Leon Ave NE",
    "address2" => "Suite 5000",
    "city" => "Atlanta",
    "state" => "GA",
    "zip" => "30308",
    "country" => "US",
    "phone" => "12345678",
  ),
  "permission_reminder" => "You're receiving this email because you signed up for updates.",
  "use_archive_bar" => true,
  "campaign_defaults" => array(
    "from_name" => "test",
    "from_email" => "test@test.com",
    "subject" => "test_subject",
    "language" => "en",
  ),
	"notify_on_subscribe" => "",
	"notify_on_unsubscribe" => "",
	"email_type_option" => true,
	"visibility" => "pub",
);


// The decoded JSON from the second query here.
$final_res = new Coroutine(function () use ($client) {
  // create a list
  $url_display_list = 'lists';
  $req_create_list = new Request('POST', $url_display_list, $headers, json_encode($data_list));
  // yield an iterate obj
  $res_create_list = (yield $client->sendAsync('POST', $req_create_list));

  yield json_decode($res_create_list->getBody()->getContents(), true);

  // Do something with the first response and prepare the second query.

  //$response2 = (yield $client->sendAsync('POST', $url2));
  // Decode JSON and/or do other stuff with the final results.

  // The final return value of the coroutine.
  //yield json_decode($response2->getBody()->getContents(), true);
});
