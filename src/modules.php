<?php

const modules = [
    'JustTalkModule',
    'DeldogModule',
    "SedModule"
];

foreach(modules as $module){
    require "modules/".$module.".php";
}