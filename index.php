<?php

require_once "secret.php";
require_once "src/bootstrap.php";

$hook = json_decode(file_get_contents("php://input"));

// file_put_contents("res.json", json_encode($hook, JSON_PRETTY_PRINT));

Core::run($hook);