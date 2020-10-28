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

    public function getReplyMessageId() {
        return $this->req->message->reply_to_message->message_id ?? null;
    }

    public function getMessageText() {
        return $this->req->message->text;
    }

    public function getReplyMessageText() {
        return $this->req->message->reply_to_message->text;
    }

    public function getChatID() {
        return $this->req->message->chat->id;
    }

    public function sendMessage($text, $chatId, $options = []){
        $data = [
            "text" => $text,
            "chat_id" => $chatId
        ];

        if(!empty($options)){
            $data = array_merge($data, $options);
        }

        Http::get($this->path."/sendMessage?".http_build_query($data));
    }

    public function deleteMessage($messageId, $chatId){
        $data = [
            "message_id" => $messageId,
            "chat_id" => $chatId,
        ];
        Http::get($this->path."/deleteMessage?".http_build_query($data));
    }

    public function sendVoice($voice, $chatId, $options = []){
        $data = [
            "voice" => $voice,
            "chat_id" => $chatId
        ];

        if(!empty($options)){
            $data = array_merge($data, $options);
        }

        Http::get($this->path."/sendVoice?".http_build_query($data));
    }

    public function sendAudio($audio, $chatId, $options = []){
        $data = [
            "audio" => $audio,
            "chat_id" => $chatId
        ];

        if(!empty($options)){
            $data = array_merge($data, $options);
        }

        Http::get($this->path."/sendAudio?".http_build_query($data));
    }
}
