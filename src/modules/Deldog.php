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
        $text = $t->getReplyMessageText();
        $messageId = $t->getMessageId();
        $chatId = $t->getChatID();

        $t->deleteMessage($messageId, $chatId);
        
        $res = Http::post("https://del.dog/documents?frontend=true", $text);

        if($res->key){
            $message = "[Link Dogbin](https://del.dog/".$res->key.")\n[Link RAW](https://del.dog/raw/".$res->key.")";
            $t->sendMessage($message, $chatId, [
                "reply_to_message_id" => $t->getReplyMessageId(),
                "parse_mode" => "MARKDOWN"
            ]);
        }

    }
}