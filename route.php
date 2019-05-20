<?php

class IBRoute{

    public $fullPath;

    public $callback;

    public $method;

    public function __construct($basePath, $path, $callback, $method){

        $this->fullPath = '/'.$basePath.$path;

        $this->callback = $callback;

        $this->method = strtoupper($method);

    }

    public function match($path){

        $regex = str_replace("/","\/",$this->fullPath);

        if(preg_match("/".$regex."/",$path) && $this->method == $_SERVER['REQUEST_METHOD'])
            return true;
        else
            return false;            

    }

}