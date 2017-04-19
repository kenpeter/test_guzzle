<?php

require '../vendor/autoload.php';

// use promise
use GuzzleHttp\Promise\Promise;

// p1
$promise = new Promise();
// p2
$nextPromise = new Promise();

// promise then
$promise
  // then gets value
  ->then(function ($value) use ($nextPromise) {
    // print a
    echo $value;
    // pass on next promise, then value will be B..... not A
    // because it passes on promise
    return $nextPromise;
  })
  ->then(function ($value) {
    // then
    echo $value;
  });

// Triggers the first callback and outputs "A"
$promise->resolve('A');
// Triggers the second callback and outputs "B"
$nextPromise->resolve('B');
