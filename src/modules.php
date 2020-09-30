<?php

const modules = [
    'JustTalkModule',
    'UploadModule'
];

foreach(modules as $module){
    require "modules/".$module.".php";
}