<?php

class Router extends Singleton
{
    public function parse($path)
    {
        $request = $_REQUEST;
        $request['controller'] = app::gi()->config->default_controller;
        $request['action'] = app::gi()->config->default_action;
        $request['id'] = array();
		
        if(isset($request['route'])){
        
                $url = explode('/', $request['route']);

                if(isset($url[0]) && strtolower($url[0]) == 'cp'){
                    unset($url[0]);
                    $url = count($url) ? array_values($url) : array();
                }
                
                if(count($url)){
                    if(isset($url[0])){
                        if(!empty($url[0])){
                            $request['controller'] = $url[0];    
                        }
                        unset($url[0]);
                    }
                    if(isset($url[1])){
                        if(!empty($url[1])){
                            $request['action'] = $url[1];    
                        }
                        unset($url[1]);
                    }
    
                    if(!empty($url)){
                        $request['id'] = array_values($url);
                    }
                }

            }
		
        return $request;
    }
}
