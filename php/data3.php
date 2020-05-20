<?php

include_once 'Course.php';
include_once 'StudentClass.php';
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
                        $courseArray = array(); //Preparing a course array
                        $gradeArray = array(); //Preparing a grade array


                        //existStudent($lengthArray[1], $lengthArray[2]);
                        //For each line in the lenghtarray
                        foreach($lengthArray as $rows) {
                            array_push($studentArray, array($rows[0], $rows[1], $rows[2], (strtotime($rows[3])))); //Place row 0 - 3 in studentarray, and convert the time to unix.
                            array_push($courseArray, array($rows[4], $rows[5], $rows[6], $rows[7], $rows[8], $rows[9])); //Place row 4 - 9 in course array
                            array_push($gradeArray, array($rows[0], $rows[4], $rows[9], $rows[10])); //Place the rows 0, 4, 9, and 10 in the grade array
                        }
                    
                        $studentArray = uniqueRows($studentArray);
                        $courseArray = uniqueRows($courseArray);
                        $gradeArray = uniqueRows($gradeArray);
                        
                        $openstudents = fopen('../files/students.csv', 'a+'); //Open the students.csv file and allow for preserving the content and write to bottom
                        $opencourses = fopen('../files/courses.csv', 'a+'); //Open the courses.csv file and allow for preserving the content and write to bottom
                        $opengrades = fopen('../files/grades.csv', 'a+'); //Open the grades.csv file and allow for preserving the content and write to bottom
                        
                        foreach($studentArray as $row){
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
                        fclose($fp); //Close connection
                        

                    }


                }

                /* //Checking if the rows are unique ???? HELP HELP
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
                }  */

    } 
} 



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


    function validateStudentArray($array) {
        $temp_array = array();
        $i = 0;
        $key_array = array();
       
        foreach($array as $val) {
             if (!in_array($val->getstudNo(), $key_array)) {
                $key_array[$i] = $val->studNo;
                $temp_array[$i] = $val;
            }
            $i++; 
        }
        return $temp_array;
        $update = fopen('../files/students.csv', 'a+');
        fputcsv($update, $temp_array);
    } 

//Function for updating the rows
/* function update($unique, $csvpath) {
    $update = fopen($csvpath, 'w+'); //Open csv file and allow to write

    foreach($unique as $rows) {
        fputcsv($update, $rows); //Put the updated input in the csv file
    }

    fclose($update); //close connection
} */


?>