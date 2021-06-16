<?php
session_start();
require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Index",
    "/teacher/login" => "\AuthTeacher",
    "/student/login" => "\AuthStudent",
    "/teacher/home" => "\TeacherHome",
    "/teacher/addBook" => "\AddBook",
    "/teacher/requests" => "\ViewRequests",
    "/teacher/addStudent" => "\AddStudent",
    "/teacher/edit" => "\EditBook",
    "/teacher/approve" => "\ApproveBook",
    "/teacher/decline" => "\DeclineBook",
    "/teacher/delete" => "\DeleteBook",
    "/teacher/return" => "\ReturnBook",
    "/teacher/logout" => "\TeacherLogout",
    "/student/home" => "\StudentHome",
    "/student/logout" => "\StudentLogout",
    "/student/checkout" => "\BookCheckout",
    "/student/cancel" => "\BookCancel",
));
