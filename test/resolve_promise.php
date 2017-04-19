<?php

require '../vendor/autoload.php';

// use promise
use GuzzleHttp\Promise\Promise;

// a new promise
$promise = new Promise();
// promise with then
$promise
  ->then(function ($value) {
    // Return a value and don't break the chain
    // 2 then, run this first
    // return value for print
    return "Hello, " . $value;
  })
  // This then is executed after the first then and receives the value
  // returned from the first then.
  ->then(function ($value) {
    echo $value;
  });

// Resolving the promise triggers the $onFulfilled callbacks and outputs
// "Hello, reader".
// this is the actual run
// you can see $value is passed
$promise->resolve('reader.');
