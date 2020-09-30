<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "secret.php";
require_once "src/bootstrap.php";

$hook = json_decode(file_get_contents("php://input"));

file_put_contents("res.json", json_encode($hook, JSON_PRETTY_PRINT));

Core::run($hook);