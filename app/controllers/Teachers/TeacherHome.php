<?php



class TeacherHome{
    public function get(){
        if(isset($_SESSION['uid']) && $_SESSION['type']=='teacher'){
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
            
            header("Location: /");
        }
    }
}