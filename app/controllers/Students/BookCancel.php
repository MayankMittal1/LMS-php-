<?php

class BookCancel
{
    public function get()
    {
        if (isset($_SESSION['uid']) && $_SESSION['type'] == 'student') {
            \Model\Transactions::updateStatus($_GET['id'], 'cancelled');
            header("Location: /student/home");
        } else {
            header("Location: /");
        }
    }
}
