<?php

class JustSpeak {
    public $name = "Just Speak";
    public $command = "/js";
    public $help = "some text here";
    
    private $uri = "https://translate.google.com.br/translate_tts?";
    private $lang = "pt-br";
    private $ie = "UTF-8";
    private $client = "tw-obt";

    public function trigger(String $text): bool {
        return substr($text, 0, strlen($this->command)) === $this->command;
    }

    public function clearMessage(String $text): String {
        return substr_replace($text, "", 0, strlen($this->command));
    }

    public function main(Telegram $t): void{
        $text = $t->getMessageText();
        if (empty($text)) {
            $text = $t->getReplyMessageText();
        }
        $messageId = $t->getMessageId();
        $chatId = $t->getChatID();
        
        $options = [];
        $fromMessageId = $t->getReplyMessageId();
        if (!empty($fromMessageId)) {
            $options = [
                "reply_to_message_id" => $fromMessageId
            ];
        }

        $t->deleteMessage($messageId, $chatId);
        
        $voice = $this->speech($text);
        
        $t->sendVoice($voice, $chatId, $options);
    }
    
    private function speech(String $text) {
        return $this->uri.http_build_query([
            "ie" => $this->ie,
            "tl" => $this->lang,
            "q" => $text,
            "client" => $this->client
        ]);
    }
}