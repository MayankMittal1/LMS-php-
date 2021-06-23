<?php

namespace Controller;

class StudentLogout
{
    public function get()
    {
        if (isset($_SESSION['uid']) && $_SESSION['type'] == 'student') {
            session_destroy();
            header("Location: /");
        } else {
            header("Location: /");
        }
    }
}
