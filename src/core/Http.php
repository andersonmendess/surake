<?php

abstract class Http {
    public function json(String $uri) {
        return json_decode(file_get_contents($uri));
    }

    public function get(String $uri) {
        return file_get_contents($uri);
    }

    public function post(String $url, String $content) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}