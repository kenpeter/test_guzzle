<?php

// auto load
require 'vendor/autoload.php';

use GuzzleHttp\Psr7\Request;

// opt
$option = array(
  'base_uri' => "https://us12.api.mailchimp.com/3.0/",
  'auth' => ['apikey', '292bae37c631ac3ba03ed0640b44e6c3'],
);

// client
$client = new \GuzzleHttp\Client($option);

// data for a new list
$data = array(
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

$headers = array(
  'User-Agent' => 'testing/1.0',
  'Accept'     => 'application/json'
);

// $data should match up the field, no json =>
$req_create_list = new Request('POST', 'lists', $headers, json_encode($data));

// promise
$promise = $client
  ->sendAsync($req_create_list)
  ->then(function ($res) {
    $obj = json_decode($res->getBody());
    $list_id = $obj->id;
    
    print $list_id;

    //$first_list_id = $obj->lists[0]->id;
    //echo $first_list_id;
  });
$promise->wait();
