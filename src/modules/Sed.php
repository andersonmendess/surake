<?php

require dirname(__FILE__)."/../utils/ExpressionParser.php";

class Sed {
    public $name = "Sed";
    public $command = "s/";
    public $help = "some text here";

    public function trigger(String $text): bool {
        return substr($text, 0, strlen($this->command)) === $this->command;
    }

    public function clearMessage(String $text): String {
        return $text;
    }

    public function main(Telegram $t): void{
        $text = $t->getMessageText();
        $messageId = $t->getMessageId();
        $chatId = $t->getChatID();

        $options = [];
        $fromMessageId = $t->getReplyMessageId();
        if (!empty($fromMessageId)) {
            $options = [
                "reply_to_message_id" => $fromMessageId
            ];
        }

        if($text[1] == "/" && $text[2] == "/") {
            $t->deleteMessage($messageId, $chatId);
            $text = substr_replace($text, "", 1, 1);
        }

        $replyText = $t->getReplyMessageText();

        $ep = new ExpressionParser($replyText, $text);

        if(empty($ep->result)){
            return;
        }

        $messageId = $t->getMessageId();
        $chatId = $t->getChatID();

        $t->sendMessage($ep->result, $chatId, $options);
    }
}

