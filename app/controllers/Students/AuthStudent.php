<?php


class AuthStudent{
    public function post(){
        $a=\Model\Students::getStudent($_POST['uid'],$_POST['password']);
        if($a){
            $_SESSION['type']='student';
            $_SESSION['uid']=$a['id'];
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/student/home");
            exit();
        }else{
            echo "Invalid Credentials";
        }
    }
}