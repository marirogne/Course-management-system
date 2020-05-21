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


?>