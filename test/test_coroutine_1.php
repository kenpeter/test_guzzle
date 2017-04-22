<?php

// load
require '../vendor/autoload.php';

// wait
use Icicle\Awaitable;
// coroutine with generator
use Icicle\Coroutine\Coroutine;
// loop
use Icicle\Loop;

// generator
$generator = function () {
  // try
  try {
    // wait for this guy finished.
    // start
    // yeild
    // await, resolve,
    // Sets $start to the value returned by microtime() after approx. 1 second.
    $start = (yield Awaitable\resolve(microtime(true))->delay(1));

    // no need to yield... just print
    echo "Sleep time: ", microtime(true) - $start, "\n";

    // reject
    // Throws the exception from the rejected promise into the coroutine.
    // yield Awaitable\reject(new Exception('Rejected promise'));
  } catch (Exception $e) { // Catches promise rejection reason.
    echo "Caught exception: ", $e->getMessage(), "\n";
  }

  // resolve
  yield Awaitable\resolve('Coroutine completed!');
};

// pass gen func, and create coroutine....
$coroutine = new Coroutine($generator());

// done, then print whatever...
$coroutine->done(function ($data) {
  echo "\n". $data, "\n";
});

Loop\run();
