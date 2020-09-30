<?php

require dirname(__FILE__)."/../modules.php";

Class Modules {

    private Array $modules = [];

    function __construct() {
        foreach (modules as $module) {
            array_push($this->modules, new $module());
        }
    }

    public function getModule(String $text) {
        foreach ($this->modules as $instance) {
            if($instance->trigger($text)){
                return $instance;
            }
        }
    }
}