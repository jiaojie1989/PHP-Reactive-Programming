<?php

require_once '../vendor/autoload.php';

use React\EventLoop\StreamSelectLoop;

$loop = new StreamSelectLoop();
$loop->addTimer(1.5, function() {
    printf("[%.3f] timer 1\n", microtime(true));
//    echo "timer 1\n";
});

$counter = 0;
$loop->addPeriodicTimer(1, function () use (&$counter, $loop) {
    printf("[%.3f] periodic timer %d\n", microtime(true), ++$counter);
    if ($counter == 5) {
        $loop->stop();
    }
});

$loop->run();
