<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 26/04/2018
 * Time: 16:27
 */

class JSONCreator
{
    public function __construct($data)
    {
        $this->data = $data;

    }

    public function generate() {
        //cleaning the file
        file_put_contents("data.json", "");
        //writing
        $writer = fopen('data.json', 'w');
        fwrite($writer, json_encode($this->data));
        fclose($writer);
    }
}