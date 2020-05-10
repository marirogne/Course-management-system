<?php 

if(isset($_POST['upload'])){
    if(isset($_FILES['filename'])){
        $fileName = $_FILES['filename']['name'];
        if($_FILES['filename']['size'] > 0){
            
            $fh = fopen($_FILES['file']['tmp_name'], 'r+');
            
            $importArray = array();
            while(($row=fgetcsv($fh)) !== FALSE){
                $importArray[] = $row;
                $file = array_map('str_getcsv', file($fh));
            }


            /* $gradeArray = splitArray($importArray, 'grade');
            $studentArray = splitArray($importArray, 'student');
            $courseArray = splitArray($importArray, 'course');

            writeToFiles($gradeArray, '../files/grades.csv');
            writeToFiles($studentArray, '../files/students.csv');
            writeToFiles($courseArray, '../files/courses.csv'); */
        }


    } else {
        echo "No file selected.";
    }
}





?>