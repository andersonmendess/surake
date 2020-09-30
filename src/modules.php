<?php

const modules = [
    'JustTalk',
    'Deldog',
    "Sed"
];

foreach(modules as $module){
    require "modules/".$module.".php";
}