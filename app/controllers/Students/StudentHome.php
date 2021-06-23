<?php

namespace Controller;

class StudentHome
{
    public function get()
    {
        if (isset($_SESSION['uid']) && $_SESSION['type'] == 'student') {
            $user = \Model\Students::getStudentById($_SESSION['uid']);
            $requests = \Model\Transactions::getRequestsByStudentId($_SESSION['uid']);
            if (isset($_GET['q'])) {
                echo \View\Loader::make()->render("templates/studentHome.twig", array(
                    "user" => $user,
                    "books" => \Model\Books::getByQuery($_GET['q']),
                    "requests" => $requests,
                ));
            } else {
                echo \View\Loader::make()->render("templates/studentHome.twig", array(
                    "user" => $user,
                    "books" => \Model\Books::get_all(),
                    "requests" => $requests,
                ));
            }
        } else {
            header("Location: /");
        }
    }
}
