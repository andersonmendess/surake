<?php

const modules = [
    'JustText',
    'JustSpeak',
    'Deldog',
    "Sed"
];

foreach(modules as $module){
    require "modules/".$module.".php";
}