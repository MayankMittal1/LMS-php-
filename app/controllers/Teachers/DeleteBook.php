<?php


class DeleteBook{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                \Model\Books::deleteById($_GET['id']);
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
