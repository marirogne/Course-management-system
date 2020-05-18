<?php

include_once 'Course.php';
include_once 'StudentClass.php';
//include_once 'upload.php';



//function csvToArray($filesName){
    if(isset($_POST['upload'])){
    if(isset($_FILES['filename'])) {
        
        $fname = $_FILES["filename"]["name"];
        $ftemp = $_FILES["filename"]["tmp_name"];
        $extension = pathinfo($fname, PATHINFO_EXTENSION);
                if ($extension != 'csv'){
                    $response = array(
                        "Type" => "Error: ",
                        "Message" => "NB!!! Only CSV-files are allowed!<br> <br>"

                    );
                    echo implode($response);
                } else {
                     $lengthArray = array();
                    $row = 1;
                    if (($fp = fopen($_FILES["filename"]["tmp_name"], "r")) !== FALSE) {
                        while (($data = fgetcsv($fp, 5000, ",")) !== FALSE) {
                            $lengthArray[] = $data;
                            $row ++;
                        }
                    
                        $studentArray = array();
                        $courseArray = array();
                        $gradeArray = array();


                        //existStudent($lengthArray[1], $lengthArray[2]);
                        foreach($lengthArray as $rows) {
                            array_push($studentArray, array($rows[0], $rows[1], $rows[2], (strtotime($rows[3]))));
                            array_push($courseArray, array($rows[4], $rows[5], $rows[6], $rows[7], $rows[8], $rows[9]));
                            array_push($gradeArray, array($rows[0], $rows[4], $rows[9], $rows[10]));
                        }
                    
                
                        $openstudents = fopen('../files/students.csv', 'a+');
                        $opencourses = fopen('../files/courses.csv', 'a+');
                        $opengrades = fopen('../files/grades.csv', 'a+');
                        
                        foreach($studentArray as $row){
                            fputcsv($openstudents, $row);
                            
                        }
                        foreach($courseArray as $row){
                            fputcsv($opencourses, $row);
                        }
                        foreach($gradeArray as $row){
                            fputcsv($opengrades, $row);
                        }
                        echo "You have updated the table!";
                        

                        //array_unique($studentArray);
                        /* $studentfilepath = '../files/students.csv';
                        $studentcurrent = file_get_contents($studentfilepath);
                        $studentcurrent .= "\n" . file_get_contents($studentArray);
    
                        file_put_contents('../files/students.csv', $studentcurrent);
 */
                        fclose($fp);
                        

                    }


                }
                
                if($studentArray != uniqueRows($studentArray)){
                $uniqueStudents = uniqueRows($studentArray);
                update($uniqueStudents, '../files/students.csv', 'w+');
                //echo "Duplicate records have been removed!";
                }

                if($courseArray != uniqueRows($courseArray)){
                $uniqueCourses = uniqueRows($courseArray);
                update($uniqueCourses, '../files/courses.csv', 'w+');
                }

                if($gradeArray != uniqueRows($gradeArray)){
                $uniqueGrades = uniqueRows($gradeArray);
                update($uniqueGrades, '../files/grades.csv', 'w+');
                } 

    } 
} 



/* function removeDuplicates($array){
    $array = array_map("unserialize", array_unique(array_map("serialize", $array)));
    $array = array_values($array);
    return $array;
} */

function uniqueRows($array) {
    $array = array_map("unserialize", array_unique(array_map("serialize", $array)));
    $array = array_values($array);
    return $array;
}

function update($unique, $csvpath) {
    $update = fopen($csvpath, 'w');

    foreach($unique as $rows) {
        fputcsv($update, $rows);
    }

    fclose($update);
}

function checkGrade($grade){
    switch ($grade) {
        case 'A':
        case 'B':
        case 'C':
        case 'D':
        case 'E':
            return true;
            break;
        case 'F':
            return false;
            break;
    }
}

function gradeToNumber($grade){
    switch($grade) {
        case 'A':
            return 5;
        case 'B':
            return 4;
        case 'C':
            return 3;
        case 'D':
            return 2;
        case 'E':
            return 1;
        case 'F':
            return 0;
    }
}

function numberToGrade($grade){
    switch($grade) {
        case 5:
            return 'A';
        case 4:
            return 'B';
        case 3:
            return 'C';
        case 2:
            return 'D';
        case 1:
            return 'E';
        case 0:
            return 'F';
    }
}






?>