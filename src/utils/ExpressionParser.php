<?php

class ExpressionParser {
    private $replaceAll = false;
    private $from = "";
    private $to = "";
    private $expression;
    private $expressionSplitted;
    private $text;

    private $delimiter = "/";

    public $result;

    function __construct(String $text, String $expression) {
        $this->text = $text;
        $this->expression = $expression;

        $this->sanitize();

        if(!$this->validadeExpression()){
            return;
        } else {
            $this->run();
        }
    }

    function sanitize() {
        $this->expressionSplitted = explode($this->delimiter, $this->expression);
        foreach($this->expressionSplitted as $key => $value) {
            if($value == "\\"){
                if($key){
                    $this->expressionSplitted[$key] = "/".$this->expressionSplitted[$key+1];
                    unset($this->expressionSplitted[$key+1]);
                }
            }
            if(empty($value)){
                unset($this->expressionSplitted[$key]);
            }
        }
        $this->expressionSplitted = array_values($this->expressionSplitted);
    }

    function validadeExpression() {
    
        if($this->expressionSplitted[0] != "s"){
            return false;
        }

        if(count($this->expressionSplitted) <= 3 && count($this->expressionSplitted) >= 4){
            return false;
        }

        return true;
    }

    function replaceAllChecker() {
        if(count($this->expressionSplitted) == 4){
            if($this->expressionSplitted[3] == "g"){
                $this->replaceAll = true;
            }
        }
    }

    function preRun() {
        $this->from = $this->expressionSplitted[1];
        $this->to = $this->expressionSplitted[2];
        $this->replaceAllChecker();
    }

    function run() {
        $this->preRun();
        
        if($this->from == "*") {
            $this->from = $this->text;
        }
        
        $this->result = $this->replace();
        
    }

    function replace() {
        if($this->replaceAll){
         
            return preg_replace("/".$this->from."/", $this->to, $this->text);
        }
        

        return preg_replace("/".$this->from."/", $this->to, $this->text ,1);
    }
}