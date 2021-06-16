<?php


class ViewRequests{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                $a=\Model\Teachers::getTeacherById($_SESSION['uid']);
                echo \View\Loader::make()->render("templates/viewRequests.twig", array(
                    "user" => $a,
                    "requests" => \Model\Transactions::getRequestsTeacher(),
                ));
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
