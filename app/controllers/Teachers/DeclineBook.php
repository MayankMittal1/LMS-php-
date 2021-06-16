<?php

class DeclineBook{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                \Model\Transactions::updateStatus($_GET['id'],'declined');
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/teacher/requests");
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
