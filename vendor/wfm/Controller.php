<?php

namespace Wfm;

abstract class Controller
{

    public $data = [];
    public array $meta = ['title' => '', 'description' => '', 'keywords' => ''];
    public $layout = '';
    public $view = '';
    public object $model;

    public function __construct(public $route = []){

    }

    public function getModel()
    {
       
        $model = 'App\\Models\\'.$this->route['admin_prefix'].$this->route['controller'];
        if(class_exists($model)){
            $this->model = new $model();
        }
    }
    public function getView()
    {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
    }

    public function set($data)
    {   
        $this->data = $data;
    }

    public function setMeta($title = '', $description = '', $keywords = '')
    {
        $this->meta = ['title' => $title, 'description' => $description, 'keywords' => $keywords];
    }
}