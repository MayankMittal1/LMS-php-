<?php


class EditBook{
    public function get(){
        if(isset($_SESSION['uid']) && $_SESSION['type']=='teacher'){
                $user=\Model\Teachers::getTeacherById($_SESSION['uid']);
                echo \View\Loader::make()->render("templates/editdelete.twig", array(
                    "user" => $user,
                    "book" => \Model\Books::getById($_GET['id']),
                ));
        }
        else{
            header("Location: /");
        }
    }

    public function post(){
        if(isset($_SESSION['uid']) && $_SESSION['type']=='teacher'){
                if($_FILES["image"]['name']!=""){
                    $filename = $_FILES["image"]["name"];
                    $tempname = $_FILES["image"]["tmp_name"];   
                    $folder = "assets/images/uploads/".$filename;
                    move_uploaded_file($tempname, $folder);
                    \Model\Books::updateWithImage($_GET['id'],$_POST['bookName'],$_POST['authorName'],$_POST['genre'],$_POST['quantity'],$filename);
                }else{
                    \Model\Books::updateNoImage($_GET['id'],$_POST['bookName'],$_POST['authorName'],$_POST['genre'],$_POST['quantity']);
                }
                
                header("Location: /teacher/home");
        }
        else{
            header("Location: /");
        }
    }
}
