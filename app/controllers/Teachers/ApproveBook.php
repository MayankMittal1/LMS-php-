<?php

class ApproveBook{
    public function get(){
        if(isset($_SESSION['uid']) && $_SESSION['type']=='teacher'){
                \Model\Transactions::approveBook($_GET['id'],$_SESSION['uid']);
                
                header("Location: /teacher/requests");
        }
        else{
            header("Location: /");
        }
    }
}
