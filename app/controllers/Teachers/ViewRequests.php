<?php


class ViewRequests
{
    public function get()
    {
        if (isset($_SESSION['uid']) && $_SESSION['type'] == 'teacher') {
            $user = \Model\Teachers::getTeacherById($_SESSION['uid']);
            echo \View\Loader::make()->render("templates/viewRequests.twig", array(
                "user" => $user,
                "requests" => \Model\Transactions::getRequestsTeacher(),
            ));
        } else {
            header("Location: /");
        }
    }
}
