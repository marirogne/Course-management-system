<?php

include_once 'Course.php';
include_once 'StudentClass.php';
//include_once 'upload.php';



/* if(isset($_POST['submit'])){
    if(isset($_FILES['file'])){
        if(($handle = fopen($_FILES['file']['tmp_name'], 'r')) !== FALSE){
            while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
                
                print_r($data);
                for($i = 0; $i < count($data); $i++){
                    echo $data[$i] . "<br />\n";
                }
            }
            fclose($handle);
        }
    }
} */

function csvToArray($filesName){
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
                    //$row = 1;
                    if (($fp = fopen($_FILES["filename"]["tmp_name"], "r")) !== FALSE) {
                        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
                            $lengthArray[] = $data;
                            //$row ++;
                        }
                    
                        $studentArray = array();
                        $courseArray = array();
                        $gradeArray = array();

                        foreach($lengthArray as $rows) {
                            array_push($studentArray, array($rows[0], $rows[1], $rows[2], $rows[3]));
                            array_push($courseArray, array($rows[4], $rows[5], $rows[6], $rows[7], $rows[8], $rows[9]));
                            array_push($gradeArray, array($rows[0], $rows[4], $rows[10]));
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
                        /* $studentfilepath = '../files/students.csv';
                        $studentcurrent = file_get_contents($studentfilepath);
                        $studentcurrent .= "\n" . file_get_contents($studentArray);
    
                        file_put_contents('../files/students.csv', $studentcurrent);
 */
                        fclose($fp);
                    }
                    /* $lengthArray = array_unique($lengthArray);
                    if (count($lengthArray) == 1) {
                        $response = array (
                            "type" => "Success: ",
                            "message" => "File validation success."
                        ); 
                     $filepath = '../files/update.csv';
                    $current = file_get_contents($filepath);
                    $current .= "\n" . file_get_contents($ftemp);

                    file_put_contents('../files/update.csv', $current);
                    echo "Hooray, you have updated the table!<br>";
                     } else {
                        $response = array(
                            "type" => "Error: ",
                            "message" => "Invalid CSV."
                        );
                    } */
                }
    }   
} 

echo csvToArray('../files/update.csv');














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
            array_push($gradeArray, array($grade[0], $grade[4], $grade[10]));
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