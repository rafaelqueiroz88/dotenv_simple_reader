<?php

include_once 'getENV.php';

$env = new Environment_Manager();

// It print's a value from .env
// echo getenv('NAME');

// Print all environments
phpinfo(INFO_ENVIRONMENT);