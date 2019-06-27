<?php
class Sibling {
    
    private $modelObject = null;
    private $modelName = null;
    
    public function __construct(ModelTable $model){
        $this->modelObject = $model;
        $this->modelName = get_class($model);
    }
    
    public function previousUrl(){
        $modelName = $this->modelName;
        $res = $modelName::modelWhere('id < ? ORDER BY id DESC LIMIT 1', array($this->modelObject->id));
        return $res ? $res->url : false;
    }
    
    public function nextUrl(){
        $modelName = $this->modelName;
        $res = $modelName::modelWhere('id > ? ORDER BY id LIMIT 1', array($this->modelObject->id));
        return $res ? $res->url : false;        
    }
    
}