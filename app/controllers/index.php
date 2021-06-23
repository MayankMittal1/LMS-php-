<?php

namespace Controller;

class Index{
    public function get(){
        echo \View\Loader::make()->render("templates/index.twig");
    }
}