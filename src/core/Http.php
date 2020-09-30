<?php

abstract class Http {
    public function json(String $uri) {
        return json_decode(file_get_contents($uri));
    }

    public function get(String $uri) {
        return file_get_contents($uri);
    }
}