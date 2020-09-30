<?php

abstract class Core {

    public function run(Object $req): void {
        $modules = new Modules();

        $module = $modules->getModule($req->message->text);

        if($module == null){
            return;
        }

        $req->message->text = $module->clearMessage($req->message->text);

        $module->main(new Telegram($req));
    }
}