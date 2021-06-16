<?php

namespace Model;

class Students{
    public static function create($name,$uid,$password,$phone) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO students(name,username,password,phn) VALUES (?,?,?,?)");
        $stmt->execute([$name,$uid,$password,$phone]); 
    }


    public static function getStudent($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM students WHERE username= ? and password= ?");
        $stmt->execute([$username,$password]);
        $row = $stmt->fetch();
        return $row;
    }

    public static function getStudentById($uid) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$uid]);
        $row = $stmt->fetch();
        return $row;
    }
}