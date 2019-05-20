<?php


class IBApi{


    public $route;

    public $endPoint = []; 

    protected $basePath = 'rest';

    public $format_support = ['JSON','XML','TEXT/PLAIN'];

    public $format;

    const CHARSET = 'UTF-8';




    public function __construct(){

        $this->request = new IBRequest($_SERVER['REQUEST_METHOD']);
        
        $this->request->setGetParams($_GET);
        $this->request->setBodyParams($_POST);
        $this->request->setHeaders($_SERVER);

    }

    public function setFormat($format){

        if(in_array($format,$this->format_support)){
            $this->format = 'application/'. strtolower($format);
        }else{
            echo "Format {$format} not support";
        }
    }

    public function registerRoute($path, $arg = []){


        $this->setFormat($arg['format']);
        $this->endPoint[] = new IBRoute($this->basePath, $path, $arg['callback'], $arg['method']);
    }


    public function request(){


        $this->request->setHeader('Content-Type',$this->format.'; charset='.self::CHARSET);
      
      /*$this->request->setHeader('Content-Type',self::CONTENT_TYPE.'; charset='.self::CHARSET);

      //return  json_encode($this->request->getParams());
      ;
      echo "<pre>";
      var_dump($this->request->getHeaders());*/

      foreach($this->endPoint as $endPoint){
    
            if($endPoint->match($this->request->route)){
                call_user_func($endPoint->callback);
            }else{
                return new IBResponse(404);  
            }

      }


    }


    

}

