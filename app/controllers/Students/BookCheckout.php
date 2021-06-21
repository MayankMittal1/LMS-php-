<?php


class BookCheckout
{
    public function get()
    {
        if (isset($_SESSION['uid']) && $_SESSION['type'] == 'student') {
            $pending = \Model\Transactions::getPendingTransactionsByStudentId($_GET['id'], $_SESSION['uid']);
            if (!$pending) {
                \Model\Transactions::initializeTransaction($_GET['id'], $_SESSION['uid']);
            }
            header("Location: /student/home");
        } else {

            header("Location: /");
        }
    }
}
