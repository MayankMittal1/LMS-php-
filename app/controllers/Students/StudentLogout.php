<?php


class StudentLogout{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='student'){
                session_destroy();
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/");
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
