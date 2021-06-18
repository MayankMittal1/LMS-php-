<?php

class AuthTeacher{
    public function post(){
        $user=\Model\Teachers::getTeacher($_POST['uid'],$_POST['password']);
        session_destroy();
        if($user){
            $_SESSION['type']="teacher";
            $_SESSION['uid']=$user['id'];
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/teacher/home");
            exit();
        }else{
            echo "Invalid Credentials";
        }
    }
}