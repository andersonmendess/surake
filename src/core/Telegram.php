<?php

class Telegram {
    private $req;
    private $path = "https://api.telegram.org/bot".APIKEY;

    function __construct($message) {
        $this->req = $message;
    }

    public function getMessageId() {
        return $this->req->message->message_id;
    }

    public function getFromMessageId() {
        return $this->req->message->from->id;
    }

    public function getMessageText() {
        return $this->req->message->text;
    }

    public function getChatID() {
        return $this->req->message->chat->id;
    }

    public function sendMessage($text, $chatId, $options = []){
        $data = [
            "text" => $text,
            "chat_id" => $chatId
        ];
        $data[] = $options;

        Http::get($this->path."/sendMessage?".http_build_query($data));
    }

    public function deleteMessage($messageId, $chatId){
        $data = [
            "message_id" => $messageId,
            "chat_id" => $chatId,
        ];
        Http::get($this->path."/deleteMessage?".http_build_query($data));
    }
}