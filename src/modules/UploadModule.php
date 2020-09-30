<?php

class UploadModule {
    public $name = "Upload";
    public $command = "/upload";
    public $help = "reply some file";

    public function trigger(String $text): bool {
        return $text == $this->command;
    }

    public function clearMessage(String $text): String {
        return $text;
    }

    public function main(Telegram $t){
        $chatId = $t->getChatID();

        $t->sendMessage("Oh shit, how you got this", $chatId);
    }
}