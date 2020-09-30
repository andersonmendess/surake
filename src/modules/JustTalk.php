<?php

class JustTalk {
    public $name = "Just Talk";
    public $command = "/jt";
    public $help = "some text here";

    public function trigger(String $text): bool {
        return substr($text, 0, strlen($this->command)) === $this->command;
    }

    public function clearMessage(String $text): String {
        return substr_replace($text, "", 0, strlen($this->command));
    }

    public function main(Telegram $t): void{
        $text = $t->getMessageText();
        $messageId = $t->getMessageId();
        $chatId = $t->getChatID();

        $t->deleteMessage($messageId, $chatId);

        $t->sendMessage($text, $chatId);
    }
}