<?php

namespace Model;

class Teachers {
    public static function getTeacher($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM teachers WHERE username= ? and password= ?");
        $stmt->execute([$username,$password]);
        $row = $stmt->fetch();
        return $row;
    }

    public static function getTeacherById($uid) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM teachers WHERE id = ?");
        $stmt->execute([$uid]);
        $row = $stmt->fetch();
        return $row;
    }
}