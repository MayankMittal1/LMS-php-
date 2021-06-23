<?php

namespace Controller;

class AddBook
{
    public function get()
    {
        if (isset($_SESSION['uid'])) {
            if ($_SESSION['type'] == 'teacher') {
                $user = \Model\Teachers::getTeacherById($_SESSION['uid']);
                echo \View\Loader::make()->render("templates/addBook.twig", array(
                    "user" => $user,
                ));
            }
        }

        header("Location: /");
    }

    public function post()
    {
        if (isset($_SESSION['uid']) && $_SESSION['type'] == 'teacher') {
            $filename = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "assets/images/uploads/" . $filename;
            move_uploaded_file($tempname, $_SERVER['DOCUMENT_ROOT'] . "/" . $folder);
            \Model\Books::create($_POST['bookName'], $_POST['authorName'], $_POST['genre'], $_POST['quantity'], $filename);

            header("Location: /teacher/addBook");
        } else {
            header("Location: /");
        }
    }
}
