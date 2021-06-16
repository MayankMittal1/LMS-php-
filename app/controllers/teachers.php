<?php

class AuthTeacher{
    public function post(){
        $a=\Model\Teachers::getTeacher($_POST['uid'],$_POST['password']);
        if($a){
            $_SESSION['type']="teacher";
            $_SESSION['uid']=$a['id'];
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/teacher/home");
            exit();
        }else{
            echo "Invalid Credentials";
        }
    }
}

class TeacherHome{
    public function get(){
        if(isset($_SESSION['uid'])){
            $a=\Model\Teachers::getTeacherById($_SESSION['uid']);
            if(isset($_GET['q'])){
                echo \View\Loader::make()->render("templates/teacherHome.twig", array(
                    "user" => $a,
                    "books" => \Model\Books::getByQuery($_GET['q']),
                ));
            }else{
                echo \View\Loader::make()->render("templates/teacherHome.twig", array(
                    "user" => $a,
                ));
            }
        }
        else{
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/");
        }
    }
}

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

class ViewRequests{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                $a=\Model\Teachers::getTeacherById($_SESSION['uid']);
                echo \View\Loader::make()->render("templates/viewRequests.twig", array(
                    "user" => $a,
                    "requests" => \Model\Transactions::getRequestsTeacher(),
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
}

class ApproveBook{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                \Model\Transactions::approveBook($_GET['id'],$_SESSION['uid']);
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/teacher/requests");
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

class DeclineBook{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                \Model\Transactions::updateStatus($_GET['id'],'declined');
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/teacher/requests");
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

class AddStudent{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                $a=\Model\Teachers::getTeacherById($_SESSION['uid']);
                echo \View\Loader::make()->render("templates/addStudent.twig", array(
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
                \Model\Students::create($_POST['studentName'],$_POST['userId'],$_POST['password'],$_POST['phone']);
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/teacher/home");
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

class EditBook{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                $a=\Model\Teachers::getTeacherById($_SESSION['uid']);
                echo \View\Loader::make()->render("templates/editdelete.twig", array(
                    "user" => $a,
                    "book" => \Model\Books::getById($_GET['id']),
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
                if($_FILES["image"]['name']!=""){
                    $filename = $_FILES["image"]["name"];
                    $tempname = $_FILES["image"]["tmp_name"];   
                    $folder = "assets/images/uploads/".$filename;
                    move_uploaded_file($tempname, $folder);
                    \Model\Books::updateWithImage($_GET['id'],$_POST['bookName'],$_POST['authorName'],$_POST['genre'],$_POST['quantity'],$filename);
                }else{
                    \Model\Books::updateNoImage($_GET['id'],$_POST['bookName'],$_POST['authorName'],$_POST['genre'],$_POST['quantity']);
                }
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/teacher/home");
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

class DeleteBook{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                \Model\Books::deleteById($_GET['id']);
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/teacher/home");
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

class ReturnBook{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                \Model\Transactions::returnBook($_GET['id']);
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/teacher/home");
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

class TeacherLogout{
    public function get(){
        if(isset($_SESSION['uid'])){
            if($_SESSION['type']=='teacher'){
                session_destroy();
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/");
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