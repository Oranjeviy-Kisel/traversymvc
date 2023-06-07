<?php
class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        // print_r($this->getUrl());
        $url = $this->getUrl();
        //look in controllers in controller
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
        //     // if file exists set the controller
            $this->currentController = ucwords($url[0]);
            //unsetting 0 index in array $url($url is array from addres bar )
            unset($url[0]);
        }
        // require the controller
        require_once '../app/controllers/'. $this->currentController . '.php';
        // instantiate controller class
        $this->currentController = new $this->currentController;
        // то есть строчка выше возъмет первый эл массива, превратит его в $ и назначит класс
        //напр $pages = new Pages

        //check if second part og url is
        if(isset($url[1])){
            //check if method exists in controller
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                //unset $url[1] значение
                unset($url[1]);
            }
            // echo $this->currentMethod; 
        }

        // Get params
        $this->params = $url ? array_values($url) : [];

        // call a callback with array of params
        call_user_func_array([$this->currentController, 
        $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }else{
            return (['']);
        }
    }
}

?>