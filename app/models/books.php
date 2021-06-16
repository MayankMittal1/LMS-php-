<?php

namespace Model;

class Books{
    public static function create($name,$author,$genre,$quantity,$image) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO books(name,author,genre,quantity,image) VALUES (?,?,?,?,?)");
        $stmt->execute([$name,$author,$genre,$quantity,$image]);
    }

    public static function get_all(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("select * from books limit 10");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function getByQuery($q){
        $db = \DB::get_instance();
        $query="%".$q."%";
        $stmt = $db->prepare("select * from books where name like ? or author like ? or genre like ? ");
        $stmt->execute([$query,$query,$query,]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function getById($id){
        $db = \DB::get_instance();
        $stmt = $db->prepare("select * from books where id = ?");
        $stmt->execute([$id]);
        $rows = $stmt->fetch();
        return $rows;
    }

    public static function deleteById($id){
        $db = \DB::get_instance();
        $stmt = $db->prepare("delete from books where id = ?");
        $stmt->execute([$id]);
    }

    public static function updateWithImage($id,$name,$author,$genre,$quantity,$image) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("update books set name = ? , author = ? , genre = ? , quantity = ? , image = ? where id = ?");
        $stmt->execute([$name,$author,$genre,$quantity,$image,$id]);
    }

    public static function updateNoImage($id,$name,$author,$genre,$quantity) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("update books set name = ? , author = ? , genre = ? , quantity = ? where id = ?");
        $stmt->execute([$name,$author,$genre,$quantity,$id]);
    }

}