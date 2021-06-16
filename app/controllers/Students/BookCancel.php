<?php

class BookCancel{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='student'){
                \Model\Transactions::updateStatus($_GET['id'],'cancelled');
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/student/home");
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