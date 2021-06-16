<?php

class AuthTeacher{
    public function post(){
        $a=\Model\Teachers::getTeacher($_POST['uid'],$_POST['password']);
        if($a){
            $_SESSION['type']="teacher";
            $_SESSION['uid']=$a['id'];
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/teacher/home");
            exit();
        }else{
            echo "Invalid Credentials";
        }
    }
}