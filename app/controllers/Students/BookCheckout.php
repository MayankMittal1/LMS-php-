<?php


class BookCheckout{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='student'){
                $pending=\Model\Transactions::getPendingTransactionsByStudentId($_GET['id'],$_SESSION['uid']);
                if(!$pending){
                    \Model\Transactions::initialize($_GET['id'],$_SESSION['uid']);
                }
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
