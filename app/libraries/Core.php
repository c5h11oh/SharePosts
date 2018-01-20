<?php
    /*
     App Core Class
     Creates URL & Load Core Controller
     URL FORMAT - /controller/method/params
     */
    class Core{
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];
        
        function __construct(){
            $url = $this->getUrl();
            //print_r($url);
            //Look in controllers for first value
            //If exists, set as controller
            if(file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')){
                $this->currentController = ucfirst($url[0]);
                // Unset 0 index
                unset($url[0]);
            }

            //require the controller
            require_once('../app/controllers/' . $this->currentController . '.php');

            //instantiate
            $this->currentController = new $this->currentController;
            
            //check 2nd part of URL
            if(isset($url[1])){
                //check if method exists in that method, or it will be 'index' method
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    //unset index url[1]
                    
                }
                unset($url[1]);
            }

            //get params
            $this->params = $url ? array_values($url) : [];

            // echo '<br> Now the $params is ';
            // print_r($this->params);

            //call a callback with the params we just obtained
            call_user_func_array([$this->currentController,$this->currentMethod], $this->params);

        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'] , '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
        
    }
    