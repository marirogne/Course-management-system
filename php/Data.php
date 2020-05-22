<?php

//Include class files
include_once 'classes/CourseClass.php';
include_once 'classes/StudentClass.php';


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
            $row = 1; //Define the row
            if (($fp = fopen($ftemp, "r")) !== FALSE) {
                while (($data = fgetcsv($fp, 5000, ",")) !== FALSE) {
                    $lengthArray[] = $data; //get the information in the upload CSV file and place it in the lengthArray
                    $row ++; //Increase the row
                }
                
                $studentArray = array(); //Preparing a student array
                $studrow = 1; //Define the studentrow
                if (($studfp = fopen('../files/students.csv', "r")) !== FALSE) {
                    while (($data = fgetcsv($studfp, 5000, ",")) !== FALSE) {
                        $studentArray[] = $data; //get the information in the upload CSV file and place it in the lengthArray
                        $studrow ++; //Increase the studentrow
                    }
                }
                    
                $courseArray = array(); //Preparing a course array
                $courserow = 1; //Define the courserow
                if (($coursefp = fopen('../files/courses.csv', "r")) !== FALSE) {
                    while (($data = fgetcsv($coursefp, 5000, ",")) !== FALSE) {
                        $courseArray[] = $data; //get the information in the upload CSV file and place it in the lengthArray
                        $courserow ++; //Increase the courserow
                    }
                }
  
                $gradeArray = array(); //Preparing a grade array
                $graderow = 1; //Define the graderow
                if (($gradefp = fopen('../files/grades.csv', "r")) !== FALSE) {
                    while (($data = fgetcsv($gradefp, 5000, ",")) !== FALSE) {
                        $gradeArray[] = $data; //get the information in the upload CSV file and place it in the lengthArray
                        $graderow ++; //Increase the graderow
                    }
                }
                    
                //For each line in the lenghtarray
                foreach($lengthArray as $rows) {
                    array_push($studentArray, array($rows[0], $rows[1], $rows[2], (strtotime($rows[3])))); //Place row 0 - 3 in studentarray, and convert the time to unix.
                    array_push($courseArray, array($rows[4], $rows[5], $rows[6], $rows[7], $rows[8], $rows[9])); //Place row 4 - 9 in course array
                    array_push($gradeArray, array($rows[0], $rows[4], $rows[9], $rows[10])); //Place the rows 0, 4, 9, and 10 in the grade array
                }
                
                //Validating the arrays and checking of the new input is unique
                $studentArray = validateArray($studentArray);
                $studentArray = uniqueRows($studentArray);
                $courseArray = validateArray($courseArray);
                $courseArray = uniqueRows($courseArray);
                $gradeArray = validateGradeArray($gradeArray);
                $gradeArray = uniqueRows($gradeArray);
                
                $openstudents = fopen('../files/students.csv', 'w+'); //Open the students.csv file and allow for preserving the content
                $opencourses = fopen('../files/courses.csv', 'w+'); //Open the courses.csv file and allow for preserving the content
                $opengrades = fopen('../files/grades.csv', 'w+'); //Open the grades.csv file and allow for preserving the content
                
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
                

                //Close connections
                fclose($openstudents);
                fclose($opencourses);
                fclose($opengrades);
                fclose($fp);       
            }
        }
    }
}



/* function CSVtoArray($array, $csvpath){
    $array = array(); //Preparing a grade array
    $row = 1;
    if (($fp = fopen($csvpath, "r")) !== FALSE) {
        while (($data = fgetcsv($fp, 5000, ",")) !== FALSE) {
            $array[] = $data; //get the information in the upload CSV file and place it in the lengthArray
            $row ++; //?????
        }
    }
} */

/**  
 * Function for checking for unique rows
 * @param { array } $array -> The chosen array to check if the lines are unique
 * @return { array } $array -> Returns the chosen array after it being checked
 */
function uniqueRows($array) {
    $array = array_map("unserialize", array_unique(array_map("serialize", $array)));
    $array = array_values($array);
    return $array;
}

/**
 * Function for checking if a grade is pass or fail.
 * @param { string } $grade -> The grade to be checked
 *  
 */ 

function checkGrade($grade){
    switch ($grade) {
        case 'A':
        case 'B':
        case 'C':
        case 'D':
        case 'E':
            return true; //If the grade is A - E, return true.
        case 'F':
            return false; //If the grade is F return false
    }
}

/** Tutorial from https://davidwalsh.name/sort-objects
 * Functions for sorting the students and the courses
 * The function will return 0 if the comparison is equal, 
 * -1 if the comparison is smaller, thus placing it further back, 
 * and +1 if the comparison is bigger, thus placing it forward
 * @param { object } $a -> The first object to be compared and moved based on the comparison
 * @param { object } $b -> The object to compare with
 * 
*/
function sortStudents($a, $b) {
    if($a->gpa == $b->gpa){ 
        return 0; 
    }
    return ($a->gpa > $b->gpa) ? -1 : 1;
}

/**
 * @param { object } $a -> The first object to be compared and moved based on the comparison
 * @param { object } $b -> The object to compare with
 * 
 */
function sortCourses($a, $b) {
    if($a->studentsRegistered == $b->studentsRegistered){ 
        return 0; 
    }
    return ($a->studentsRegistered < $b->studentsRegistered) ? -1 : 1;
}

/** 
 * Function for validating the student array and the course array
 * @param { array } $array -> The array to be validated
 * @return { array } $validatedArray -> Returns the validated array
*/
function validateArray($array) {
    $validatedArray = array(); //Preparing the validated array
    $i = 0; //Preparing an index
    $key_array = array(); //Preparing a key array
    
    foreach($array as $row) {
            //If the first element in the array (the primary key) is not already in the key array
            if (!in_array($row[0], $key_array)) {
            $key_array[$i] = $row[0]; //The key array is equal to the first element in the row in the array
            $validatedArray[$i] = $row; //The validated array row is equal to the row
        }
        $i++; //Increase the index
    }
    return $validatedArray; //Return the validated array
}

/** 
 * Function for validating the grade array
 * @param { array } $array -> The array to be validated
 * @return { array } $validatedArray -> Returns the validated array
*/
function validateGradeArray($array) {
    $validatedArray = array(); //Preparing the validated array
    $i = 0; //Preparing an index
    $key_array = array(); //Preparing a key array
    
    foreach($array as $row){
            //If the first element and the second element in the array (the primary key) is not already in the key array
            if(!in_array($row[0], $key_array) && !in_array($row[1], $key_array)){
            $key_array[$i] = $row[0] . $row[1]; //The key array is equal to the first element in the row in the array
            $validatedArray[$i] = $row; //The validated array row is equal to the row
        }
        $i++; //Increase the index
    }
    return $validatedArray; //Return the validated array
} 





?>