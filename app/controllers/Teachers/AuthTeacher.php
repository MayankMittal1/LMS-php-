<?php

class AuthTeacher
{
    public function post()
    {
        $user = \Model\Teachers::getTeacher($_POST['uid'], $_POST['password']);
        if (isset($_SESSION['uid'])) {
            session_destroy();
        }
        if ($user) {
            $_SESSION['type'] = "teacher";
            $_SESSION['uid'] = $user['id'];

            header("Location: /teacher/home");
            exit();
        } else {
            echo "Invalid Credentials";
        }
    }
}
