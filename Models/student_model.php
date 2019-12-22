<?php

function m_get_data() {

    $query = "SELECT st.id,firstname,lastname,sex,cl.title 
                FROM student st 
                LEFT JOIN class cl ON cl.id = st.class_id";
    include "connection.php";
  
    $result = mysqli_query($connection,$query);
 
    $rows = [];
   
    if($result && mysqli_num_rows($result) > 0 ){
        foreach ($result as $record) {
           
            $rec = [];
            $subject = [];
            $querySubject = "SELECT sub_title FROM subjects su
                                INNER JOIN student_has_subjects ss ON su.id = ss.subjects_id
                                INNER JOIN student st ON st.id = ss.student_id
                                WHERE st.id=".$record['id'];
      
            $res = mysqli_query($connection,$querySubject);
       
            foreach($res as $sub){
               array_push($subject,$sub['sub_title']);               
            }
           
            $rec = $record;
            $rec['sub_title'] = $subject;      
            array_push($rows,$rec);
        }
        
    }
  
    return $rows;
}

function get_class_data() {
    $query = "select * from class";
    include "connection.php";
    $result = mysqli_query($connection,$query);
    $rows = [];
    if($result && mysqli_num_rows($result) > 0 ){
        foreach ($result as $record) {
            $rows[] = $record;
        }
    }
    return $rows;
}



function student_add_data($data) {
    include "connection.php";
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $sex = $_POST['sex'];
    $class_id = $_POST['class'];
    $subjects= $_POST['subjects'];
    
    $query = "INSERT INTO student(firstname,lastname,sex,class_id)
              VALUES('$firstname','$lastname','$sex','$class_id')";
    mysqli_query($connection, $query);

    foreach ($subjects as $subject) {
        $last_student = "SELECT id FROM student ORDER BY id DESC LIMIT 1";
        $last_student = mysqli_query($connection, $last_student);
        foreach ($last_student as $student) {
          $id = $student['id'];
          $query_subject = "INSERT INTO student_has_subjects(student_id, subjects_id) VALUES($id,$subject)";
        }
        $result = mysqli_query($connection, $query_subject);
    }

    return $result;
}


function delete_data(){
    $id = $_GET['id'];
    include "connection.php";
    $delete = "DELETE FROM student WHERE id = $id";
    $result = mysqli_query($connection, $delete);
    return $result;
}

function get_subject_data() {
    $query = "select * from subjects";
    include "connection.php";
    $result = mysqli_query($connection,$query);
    $rows = [];
    if($result && mysqli_num_rows($result) > 0 ){
        foreach ($result as $record) {
            $rows[] = $record;
        }
    }
    return $rows;
}






function get_subject_edit_data(){
    $query = "select * from subjects";
    include "connection.php";
    $result = mysqli_query($connection,$query);
    $rows = [];
    if($result && mysqli_num_rows($result) > 0 ){
        foreach ($result as $record) {
            $rows[] = $record;
        }
    }
    return $rows;
}

function get_class_data_edit(){
    $query = "select * from class";
    include "connection.php";
    $result = mysqli_query($connection,$query);
    $rows = [];
    if($result && mysqli_num_rows($result) > 0 ){
        foreach ($result as $record) {
            $rows[] = $record;
        }
    }
    return $rows;
}

function m_edit() {
    $id = $_GET['id'];
    $query = "SELECT st.id,firstname,lastname,sex,cl.title 
                FROM student st 
                LEFT JOIN class cl ON cl.id = st.class_id WHERE st.id= $id";
    include "connection.php";
    $result = mysqli_query($connection,$query);
    $rows = [];
    if($result && mysqli_num_rows($result) > 0 ){
        foreach ($result as $record) {
            $rows[] = $record;
        }
    }
    return $rows;
}

function m_update_data() {
    include "connection.php";
    $id  = $_POST['id'];
    $name = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $class = $_POST['class'];
    $sex = $_POST['sex'];
    $subjects = $_POST['subjects'];

    $row = [];
    foreach ( $subjects as $value) {
        $row[] = $value;
    }
    $query ="UPDATE student st INNER JOIN class cl  SET firstname = '$name', lastname = '$lastname', sex = '$sex', class_id = $class WHERE st.id = $id";
    $update = mysqli_query($connection, $query);
    return $update;
}
