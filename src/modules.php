<?php

const modules = [
    'JustTalkModule',
    'DeldogModule'
];

foreach(modules as $module){
    require "modules/".$module.".php";
}