<?php

const modules = [
    'JustTalkModule',
    'UploadModule',
    'DeldogModule'
];

foreach(modules as $module){
    require "modules/".$module.".php";
}