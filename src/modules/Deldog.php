<?php

class Deldog {
    public $name = "DelDog";
    public $command = "/dd";
    public $help = "reply some file or Text";

    public function trigger(String $text): bool {
        return $text == $this->command;
    }

    public function clearMessage(String $text): String {
        return $text;
    }

    public function main(Telegram $t){
        $chatId = $t->getChatID();
        $text = $t->getReplyMessageText();
        $msgId = $t->getMessageId();

        $res = Http::post("https://del.dog/documents?frontend=true", $text);

        if($res->key){
            $t->sendMessage("https://del.dog/".$res->key, $chatId, [
                "reply_to_message_id" => $msgId
            ]);
        }

    }
}