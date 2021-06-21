<?php


class DeleteBook
{
    public function get()
    {
        if (isset($_SESSION['uid']) && $_SESSION['type'] == 'teacher') {
            \Model\Books::deleteById($_GET['id']);

            header("Location: /teacher/home");
        } else {

            header("Location: /");
        }
    }
}
