<?php

abstract class Core {

    static public function main(Object $req): void {

        if(!isset($req->message->text)){
            return;
        }

        $modules = new Modules();

        $module = $modules->getModule($req->message->text);

        if($module == null){
            return;
        }

        $req->message->text = $module->clearMessage($req->message->text);

        $module->main(new Telegram($req));
    }

    static function hook(Object $msg) {
        self::main($msg);
    }

    static function run() {
        $offset = 0;
        echo "Bot started \n";
        while(true) {
            $res = Http::json("https://api.telegram.org/bot".APIKEY."/getUpdates?timeout=30&offset=".$offset);
            
            if(count($res->result) > 0){
                $offset = end($res->result)->update_id + 1;

                foreach($res->result as $msg){
                    self::main($msg);
                }
            }
        }
    }
}