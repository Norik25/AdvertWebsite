<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 12/02/2018
 * Time: 20:32
 */

class Messages
{
    public function __construct($messages) {
        $this->messages = $messages;
    }


    public function displayMessages() {
        if (count($this->messages) > 0) {
            foreach ($this->messages as $message) {
                echo $message;
            }
        }
    }
}