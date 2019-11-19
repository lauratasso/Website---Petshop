<?php
class View {
    private $contents;
    private $view;
    private $parameters;

    function __construct($view=null, $parameters=null){
        $this->view = $view;
        $this->parameters = $parameters;
    }

    public function getContents(){
        return $this->contents;
    }

    public function setContents($contents){
        $this->contents = $contents;
    }

    public function getView(){
        return $this->view;
    }

    public function setView($view){
        $this->view = $view;
    }

    public function getParameters(){
        return $this->parameters;
    }

    public function setParameters($parameters){
        $this->parameters = $parameters;
    }

    public function show(){
        echo $this->contents;
        exit;
    }
}
?>