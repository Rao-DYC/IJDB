<?php

include __DIR__ . '/../includes/autoload.php';
$uri = strtok(ltrim($_SERVER['REQUEST_URI'], '/'), '?');
$website = new \Ijdb\JokeWebsite();
$entry_point = new \Ninja\EntryPoint($website);
$entry_point->run($uri);
