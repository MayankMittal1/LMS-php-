<?php

class StudentHome{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='student'){
                $a=\Model\Students::getStudentById($_SESSION['uid']);
                $requests=\Model\Transactions::getRequestsByStudentId($_SESSION['uid']);
                if(isset($_GET['q'])){
                    echo \View\Loader::make()->render("templates/studentHome.twig", array(
                        "user" => $a,
                        "books" => \Model\Books::getByQuery($_GET['q']),
                        "requests" => $requests,
                    ));
                }else{
                    echo \View\Loader::make()->render("templates/studentHome.twig", array(
                        "user" => $a,
                        "books" => \Model\Books::get_all(),
                        "requests" => $requests,
                    ));
                }
            }else{
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/");
            }
        }
        else{
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/");
        }
    }
}