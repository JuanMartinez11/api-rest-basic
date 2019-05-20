<?php


class IBRequest{


    protected $method;

    protected $params = [];

    protected $verbs = ['GET','POST','PUT','DELETE'];

    public $headers = [];

    public function __construct($method){

        $path = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        
        $this->setRoute($path);
        $this->setMethod($method);

    }

    public function setMethod($method){

        $this->method = $method;

    }

    public function setRoute($path){

        $this->route = $path;

    }


    public function setGetParams($params){

        $this->params['GET'] = $params;

    }
    public function setBodyParams($params){

        $this->params['POST'] = $params;

    }

    public function getParams(){

        $params = [];

        foreach($this->verbs as $verb){
            
            if(isset($this->params[$verb])){
                foreach($this->params[$verb] as $key => $value){
                    $params[$verb][$key] = $value;
                }
            }
        }
        return $params;
    }

    public function setHeader($type, $content){
       
        header(sprintf('%s: %s',$type,$content));

    }

    public function setHeaders($server){

        foreach ($server as $key => $value){

            if(strpos($key, 'HTTP_') === 0){
                $header = substr($key,5,(strlen($key)-1));
                $this->headers[$header] = $value;
            }

        }
    }

    public function getHeaders(){
        return  $this->headers;
    }


}