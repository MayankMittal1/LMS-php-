<?php

namespace Model;

class Transactions{
    public static function initialize($bookId,$studentId){
        $db = \DB::get_instance();
        $stmt = $db->prepare("insert into transactions(book_id,student_id,status) values(?,?,'pending')");
        $stmt->execute([$bookId,$studentId]);
    }

    public static function getPendingTransactionsByStudentId($bookId,$studentId){
        $db = \DB::get_instance();
        $stmt = $db->prepare("select * from transactions where book_id = ? and student_id = ? and status ='pending'");
        $stmt->execute([$bookId,$studentId]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function getRequestsByStudentId($studentId){
        $db = \DB::get_instance();
        $stmt = $db->prepare("select t.id,t.status,b.name,b.author,b.genre,b.image from transactions t join books b where t.book_id=b.id and t.student_id= ? ");
        $stmt->execute([$studentId]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function updateStatus($id,$status){
        $db = \DB::get_instance();
        $stmt = $db->prepare("update transactions set status = ? where id = ? ");
        $stmt->execute([$status,$id]);
    }

    public static function approveBook($id,$teacherId){
        $db = \DB::get_instance();
        $stmt = $db->prepare("update transactions set status = 'approved', teacher_id= ? , issue_date = ? where id = ? ");
        $stmt->execute([$teacherId,date("Y-m-d"),$id]);
        $stmt = $db->prepare("select * from transactions where id = ?");
        $stmt->execute([$id]);
        $rows = $stmt->fetch();
        $stmt = $db->prepare("update books set quantity= quantity-1 where id =?");
        $stmt->execute([$rows['book_id']]);
    }

    public static function returnBook($id){
        $db = \DB::get_instance();
        $stmt = $db->prepare("update transactions set status = 'returned', return_date = ? where id = ? ");
        $stmt->execute([date("Y-m-d"),$id]);
        $stmt = $db->prepare("select * from transactions where id = ?");
        $stmt->execute([$id]);
        $rows = $stmt->fetch();
        $stmt = $db->prepare("update books set quantity= quantity+1 where id =?");
        $stmt->execute([$rows['book_id']]);
    }

    public static function getRequestsTeacher(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("select t.id,t.status,b.name book,b.quantity,b.image,s.name,s.username,t.issue_date,t.return_date from transactions t join books b join students s where t.book_id=b.id and s.id=t.student_id  ORDER BY FIELD(t.status, 'pending','declined','approved','returned','cancelled')");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
}