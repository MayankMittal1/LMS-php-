<?php
session_start();
require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "Controller\Index",
    "/teacher/login" => "Controller\AuthTeacher",
    "/student/login" => "Controller\AuthStudent",
    "/teacher/home" => "Controller\TeacherHome",
    "/teacher/addBook" => "Controller\AddBook",
    "/teacher/requests" => "Controller\ViewRequests",
    "/teacher/addStudent" => "Controller\AddStudent",
    "/teacher/edit" => "Controller\EditBook",
    "/teacher/approve" => "Controller\ApproveBook",
    "/teacher/decline" => "Controller\DeclineBook",
    "/teacher/delete" => "Controller\DeleteBook",
    "/teacher/return" => "Controller\ReturnBook",
    "/teacher/logout" => "Controller\TeacherLogout",
    "/student/home" => "Controller\StudentHome",
    "/student/logout" => "Controller\StudentLogout",
    "/student/checkout" => "Controller\BookCheckout",
    "/student/cancel" => "Controller\BookCancel",
));
