<?php

namespace Controller;

class TeacherLogout
{
    public function get()
    {
        if (isset($_SESSION['uid'])) {
            session_destroy();

            header("Location: /");
        } else {

            header("Location: /");
        }
    }
}
