<?php



class TeacherHome{
    public function get(){
        if(isset($_SESSION['uid'])){
            $user=\Model\Teachers::getTeacherById($_SESSION['uid']);
            if(isset($_GET['q'])){
                echo \View\Loader::make()->render("templates/teacherHome.twig", array(
                    "user" => $user,
                    "books" => \Model\Books::getByQuery($_GET['q']),
                ));
            }else{
                echo \View\Loader::make()->render("templates/teacherHome.twig", array(
                    "user" => $user,
                ));
            }
        }
        else{
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/");
        }
    }
}