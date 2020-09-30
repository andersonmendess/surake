<?php

const modules = [
    'JustText',
    'Deldog',
    "Sed"
];

foreach(modules as $module){
    require "modules/".$module.".php";
}