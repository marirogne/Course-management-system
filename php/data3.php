<?php

include_once 'Course.php';
include_once 'StudentClass.php';
//include_once 'students.php';
//include_once 'upload.php';



//function csvToArray($filesName){
    if(isset($_POST['upload'])){ //If the upload-button is pushed
    if(isset($_FILES['filename'])) {
        
        $fname = $_FILES["filename"]["name"]; //Decalte filename
        $ftemp = $_FILES["filename"]["tmp_name"]; //Declare temporary name USIKKE PÅ DENNE HALLOO=???
        $extension = pathinfo($fname, PATHINFO_EXTENSION);
                if ($extension != 'csv'){ //If the file is not a CSV-file
                    $response = array(
                        "Type" => "Error: ",
                        "Message" => "NB!!! Only CSV-files are allowed!<br> <br>"

                    );
                    echo implode($response); //Display the error message
                } else {
                    $lengthArray = array(); //Prepare an array for the uploaded csv-file
                    $row = 1;
                    if (($fp = fopen($_FILES["filename"]["tmp_name"], "r")) !== FALSE) {
                        while (($data = fgetcsv($fp, 5000, ",")) !== FALSE) {
                            $lengthArray[] = $data; //get the information in the upload CSV file and place it in the lengthArray
                            $row ++; //?????
                        }
                        
                        $studentArray = array(); //Preparing a student array
                        $studrow = 1;
                        if (($studfp = fopen('../files/students.csv', "r")) !== FALSE) {
                            while (($data = fgetcsv($studfp, 5000, ",")) !== FALSE) {
                                $studentArray[] = $data; //get the information in the upload CSV file and place it in the lengthArray
                                $studrow ++; //?????
                            }
                        }
                        
                        
                        //$studentArray = uniqueRows($studentArray);
                        $courseArray = array(); //Preparing a course array
                        $courserow = 1;
                        if (($coursefp = fopen('../files/courses.csv', "r")) !== FALSE) {
                            while (($data = fgetcsv($coursefp, 5000, ",")) !== FALSE) {
                                $courseArray[] = $data; //get the information in the upload CSV file and place it in the lengthArray
                                $courserow ++; //?????
                            }
                        }

                        $gradeArray = array(); //Preparing a grade array
                        $graderow = 1;
                        if (($gradefp = fopen('../files/grades.csv', "r")) !== FALSE) {
                            while (($data = fgetcsv($gradefp, 5000, ",")) !== FALSE) {
                                $gradeArray[] = $data; //get the information in the upload CSV file and place it in the lengthArray
                                $graderow ++; //?????
                            }
                        }


                        //existStudent($lengthArray[1], $lengthArray[2]);
                        //For each line in the lenghtarray
                        foreach($lengthArray as $rows) {
                            array_push($studentArray, array($rows[0], $rows[1], $rows[2], (strtotime($rows[3])))); //Place row 0 - 3 in studentarray, and convert the time to unix.
                            array_push($courseArray, array($rows[4], $rows[5], $rows[6], $rows[7], $rows[8], $rows[9])); //Place row 4 - 9 in course array
                            array_push($gradeArray, array($rows[0], $rows[4], $rows[9], $rows[10])); //Place the rows 0, 4, 9, and 10 in the grade array
                        }
                        
                        $studentArray = validateArray($studentArray);
                        $studentArray = uniqueRows($studentArray);
                        $courseArray = validateArray($courseArray);
                        $courseArray = uniqueRows($courseArray);
                        $gradeArray = validateGradeArray($gradeArray);
                        $gradeArray = uniqueRows($gradeArray);

                        //$studentArray = studentToObject($studentArray);
                        
                        $openstudents = fopen('../files/students.csv', 'w+'); //Open the students.csv file and allow for preserving the content and write to bottom
                        $opencourses = fopen('../files/courses.csv', 'w+'); //Open the courses.csv file and allow for preserving the content and write to bottom
                        $opengrades = fopen('../files/grades.csv', 'w+'); //Open the grades.csv file and allow for preserving the content and write to bottom
                        
                        //update($studentArray, '../files/students.csv');
                        foreach($studentArray as $row){
                            //validateing($row);
                            fputcsv($openstudents, $row); //take the studentarray and put the content into the student.csv file
                        }
                        foreach($courseArray as $row){
                            fputcsv($opencourses, $row); //take the coursearray and put the content into the courses.csv file
                        }
                        foreach($gradeArray as $row){
                            fputcsv($opengrades, $row); //take the gradearray and put the content into the grades.csv file
                        }
                        echo "You have updated the table!"; //Echo message
                        

                        //array_unique($studentArray);
                        /* $studentfilepath = '../files/students.csv';
                        $studentcurrent = file_get_contents($studentfilepath);
                        $studentcurrent .= "\n" . file_get_contents($studentArray);
    
                        file_put_contents('../files/students.csv', $studentcurrent);
                        */
                        fclose($openstudents);
                        fclose($opencourses);
                        fclose($opengrades);
                        fclose($fp); //Close connection
                        
                    }


                
                
                }

                //Checking if the rows are unique ???? HELP HELP
                /* if($studentArray != uniqueRows($studentArray)){
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
                }  */

    }

/* 
    if (($fp = fopen('../files/students.csv', 'r')) !== FALSE) {
        $studArray = array();
        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
            $studArray[] = $data;
            //$row ++;
        }
    
        $temp_array = array();
        $i = 0;
        $key_array = array();
        foreach($studArray as $student){
            if(!in_array($student[0], $key_array)){
                $key_array[$i] = $student[0];
                $temp_array[$i] = $student;
            }
            $i++;
        }
        return $temp_array;
    
    }
} */

    }
/* function validateing($array) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
    foreach($array as $student){
        if(!in_array($student[0], $key_array)){
            $key_array[$i] = $student[0];
            $temp_array[$i] = $student;
        }
        $i++;
    }
    return $temp_array;
}  */
/* $studentsArray = array();
if(isset($_POST['upload'])){
    validate($studentsArray, '../files/students.csv');
}
//$studentsArray = array();
function validate($array, $csvPath){
    
    if (($fp = fopen($csvPath, 'r')) !== FALSE) {
        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
            $array[] = $data;
        
        //$row ++;
        }
        uniqueRows($array);
        update($array, $csvPath);
        fclose($fp);

    }

} */

/* function removeDuplicates($array){
    $array = array_map("unserialize", array_unique(array_map("serialize", $array)));
    $array = array_values($array);
    return $array;
} */

//Function for checking for unique rows
function uniqueRows($array) {
    $array = array_map("unserialize", array_unique(array_map("serialize", $array)));
    $array = array_values($array);
    return $array;
}




//Function for checking if a grade is pass or fail
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

function sortStudents($a, $b) {
    if($a->gpa == $b->gpa){ 
        return 0 ; 
    }
    return ($a->gpa > $b->gpa) ? -1 : 1;
}
    //Tutorial from https://davidwalsh.name/sort-objects
    function sortCourses($a, $b) {
        if($a->studentsRegistered == $b->studentsRegistered){ 
            return 0 ; 
        }
        if($a->studentsRegistered < $b->studentsRegistered){
            return -1;
        } else {
            return 1;
        }
        //return ($a->studentsRegistered < $b->studentsRegistered) ? -1 : 1;
    }


    function validateArray($array) {
        $temp_array = array();
        $i = 0;
        $key_array = array();
       
        foreach($array as $val) {
             if (!in_array($val[0], $key_array)) {
                $key_array[$i] = $val[0];
                $temp_array[$i] = $val;
            }
            $i++; 
        }
        return $temp_array;
    }

    function validateGradeArray($array) {
        $temp_array = array();
        $i = 0;
        $key_array1 = array();
        $key_array2 = array();
       
        foreach($array as $val){
             if(!in_array($val[0], $key_array1) && !in_array($val[1], $key_array1)){
                $key_array1[$i] = $val[0] . $val[1];
                //$key_array1[$i] = $val[1];
                $temp_array[$i] = $val;
            }
            $i++; 
        }
        return $temp_array;
    } 

//Function for updating the rows
function update($array, $csvpath) {
    $csv = fopen($csvpath, 'w'); //Open csv file and allow to write
    if(is_array($array)){
        foreach($array as $row) {
            fputcsv($csv, get_object_vars($row)); //Put the updated input in the csv file
    }
    }
    fclose($csv); //close connection
}




?>