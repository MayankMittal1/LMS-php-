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

class StudentHome{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='student'){
                $a=\Model\Students::getStudentById($_SESSION['uid']);
                $requests=\Model\Transactions::getRequestsByStudentId($_SESSION['uid']);
                if(isset($_GET['q'])){
                    echo \View\Loader::make()->render("templates/studentHome.twig", array(
                        "user" => $a,
                        "books" => \Model\Books::getByQuery($_GET['q']),
                        "requests" => $requests,
                    ));
                }else{
                    echo \View\Loader::make()->render("templates/studentHome.twig", array(
                        "user" => $a,
                        "books" => \Model\Books::get_all(),
                        "requests" => $requests,
                    ));
                }
            }else{
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