<?php


class AuthStudent{
    public function post(){
        if(isset($_SESSION['uid'])){
            session_destroy();
        }
        $user=\Model\Students::getStudent($_POST['uid'],$_POST['password']);
        if($user){
            $_SESSION['type']='student';
            $_SESSION['uid']=$user['id'];
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/student/home");
            exit();
        }else{
            echo "Invalid Credentials";
        }
    }
}