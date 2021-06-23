<?php

namespace Controller;

class ReturnBook
{
    public function get()
    {
        if (isset($_SESSION['uid']) && $_SESSION['type'] == 'teacher') {
            \Model\Transactions::returnBook($_GET['id']);

            header("Location: /teacher/home");
        } else {

            header("Location: /");
        }
    }
}
