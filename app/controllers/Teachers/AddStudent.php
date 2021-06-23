<?php

namespace Controller;

class AddStudent
{
    public function get()
    {
        if (isset($_SESSION['uid']) && $_SESSION['type'] == 'teacher') {
            $user = \Model\Teachers::getTeacherById($_SESSION['uid']);
            echo \View\Loader::make()->render("templates/addStudent.twig", array(
                "user" => $user,
            ));
        } else {
            header("Location: /");
        }
    }
    public function post()
    {
        if (isset($_SESSION['uid']) && $_SESSION['type'] == 'teacher') {
            \Model\Students::create($_POST['studentName'], $_POST['userId'], $_POST['password'], $_POST['phone']);
            header("Location: /teacher/home");
        } else {
            header("Location: /");
        }
    }
}
