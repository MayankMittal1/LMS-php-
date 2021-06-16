<?php


class AddBook{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                $a=\Model\Teachers::getTeacherById($_SESSION['uid']);
                echo \View\Loader::make()->render("templates/addBook.twig", array(
                    "user" => $a,
                ));
            }
            else{
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/");
            }
        }
        else{
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/");
        }
    }

    public function post(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                $filename = $_FILES["image"]["name"];
                $tempname = $_FILES["image"]["tmp_name"];   
                $folder = "assets/images/uploads/".$filename;
                move_uploaded_file($tempname, $folder);
                \Model\Books::create($_POST['bookName'],$_POST['authorName'],$_POST['genre'],$_POST['quantity'],$filename);
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/teacher/addBook");
            }
            else{
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/");
            }
        }
        else{
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/");
        }
    }
}
