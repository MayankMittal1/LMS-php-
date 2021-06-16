<?php

class AddStudent{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                $a=\Model\Teachers::getTeacherById($_SESSION['uid']);
                echo \View\Loader::make()->render("templates/addStudent.twig", array(
                    "user" => $a,
                ));
            }
            else{
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/");
            }
        }
        else{
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/");
        }
    }
    public function post(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                \Model\Students::create($_POST['studentName'],$_POST['userId'],$_POST['password'],$_POST['phone']);
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/teacher/home");
            }
            else{
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