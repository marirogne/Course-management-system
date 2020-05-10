<?php

include_once 'Course.php';
include_once 'StudentClass.php';
include_once 'upload.php';



if(isset($_POST['submit'])){
    if(isset($_FILES['file'])){
        if(($handle = fopen($_FILES['file']['tmp_name'], 'r')) !== FALSE){
            while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
                
                print_r($data);
                /* for($i = 0; $i < count($data); $i++){
                    echo $data[$i] . "<br />\n";
                } */
            }
            fclose($handle);
        }
    }
}














/* if(isset($_POST['upload'])){
    if(isset($_FILES['filename'])){
        $fname = $_FILES["filename"]["name"];
        
        $extension = pathinfo($fname, PATHINFO_EXTENSION);
        if ($extension != 'csv'){
            $response = array(
                "Type" => "Error: ",
                "Message" => "NB!!! Only CSV-files are allowed!<br> <br>"

            );
            echo implode($response);
        } else {
            
            //$row = 1;
                $ftemp = $_FILES["filename"]["tmp_name"];
                $fp = fopen($ftemp, 'r+');
                $lengthArray = array();
                while (($data = fgetcsv($fp)) !== FALSE) {
                    $lengthArray[] = $data;
                    //$row ++;
                }
                //fclose($fp);
                $gradeArray = splitArray($lengthArray, 'grade');
                $studentArray = splitArray($lengthArray, 'student');
                $courseArray = splitArray($lengthArray, 'course');

                while($studentArray != 0){
                    foreach($studentArray as $line){
                        $newstud = new Student($line[0], $line[1], $line[2], $line[3]);
                    }
                }

                write($gradeArray, '../files/grades.csv');
                write($studentArray, '../files/students.csv');
                write($courseArray, '../files/courses.csv');
            }
        }

    
}

function splitArray($array, $value){
    if($value == 'student'){
        $studentArray = array();
        $studentCSV = array_map('str_getcsv', file('../files/students.csv'));
        return $studentCSV;
        if(count($studentCSV) != 0){
            foreach($studentCSV as $studCSV){
                array_push($studentArray, $studCSV);
            }
        }

        foreach($array as $student){
            array_push($studentArray, array($student[0], $student[1], $student[2], $student[3]));
        }
        return $studentArray;
    }
    if($value == 'course'){
        $courseArray = array();
        $courseCSV = array_map('str_getcsv', file('../files/courses.csv'));
        return $courseCSV;
        if(count($courseCSV) != 0){
            foreach($courseCSV as $cCSV){
                array_push($courseArray, $cCSV);
            }
        }

        foreach($array as $course){
            array_push($courseArray, array($course[4], $course[5], $course[6], $course[7], $course[8], $course[9]));
        }
        return $courseArray;
    }
    if($value == 'grade'){
        $gradeArray = array();
        $gradeCSV = array_map('str_getcsv', file('../files/grades.csv'));
        return $gradeCSV;
        if(count($gradeCSV) != 0){
            foreach($gradeCSV as $gCSV){
                array_push($gradeArray, $gCSV);
            }
        }

        foreach($array as $grade){
            array_push($gradeArray, array($grade[0], $grade[4], $grade[2], $grade[10]));
        }
        return $gradeArray;
    }
}

function write($array, $path){
    $CSV = fopen($path, 'a+');
    foreach($array as $cells){
        fputcsv($CSV, get_object_vars($cells));
    }
    fclose($CSV);
} */



?>