<?php

class DeclineBook{
    public function get(){
        if(isset($_SESSION['uid']) && $_SESSION['type']=='teacher'){
                \Model\Transactions::updateStatus($_GET['id'],'declined');
                
                header("Location: /teacher/requests");
        }
        else{
            header("Location: /");
        }
    }
}
