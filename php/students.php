<?php

include '../html/nav.html';
include_once 'StudentClass.php';
include_once 'data3.php';

$studArray = array(); //Preparing a student array
$gradeArray = array(); //Preparing a grade array
$objectArray = array(); //Preparing an array for all the objects

//Find the data from the stundets.csv file and place it in the student array
if (($fp = fopen('../files/students.csv', 'r')) !== FALSE) {
    while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
        $studArray[] = $data;
    }
    
    //Find the data from the grades.csv file and place it in the grade array
    if (($grade = fopen('../files/grades.csv', 'r')) !== FALSE) {
        while (($gradedata = fgetcsv($grade, 1000, ",")) !== FALSE) {
            $gradeArray[] = $gradedata;
        }
    }


    //Go through each line in the student array row
    foreach($studArray as $row){
        $student = new Student($row[0], $row[1], $row[2], date('d-m-Y', $row[3])); //Create a new object
        $student->coursesPassed = $student->coursesPassed($gradeArray); //Find the number of passed courses a students have
        $student->coursesFailed = $student->coursesFailed($gradeArray); //Find the number of failed courses a students have
        $student->gpa = $student->calculateGPA($gradeArray);
        $student->status = $student->setStatus($student->gpa);
        array_push($objectArray, $student);
    }

    fclose($fp); //Close the link to the students csv-file.
}


usort($objectArray, 'sortStudents');

$count = count($objectArray); //Count the number of rows int the student array
echo "<p>There are <b>$count</b> students registered.</p>"; //Display the number of students in the array

//Creating the table for the students:
echo <<< _END
<div class="content">
    <table>
        <thead>
            <tr>
                <th>Student number</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Birthdate</th>
                <th>Courses passed</th>
                <th>Courses failed</th>
                <th>GPA</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
_END;

foreach($objectArray as $object){
    $object->showStudentInfo();
}

//Finish the table structure in HTML          
echo <<< _END
            </tbody>
        </table>
    </div>

_END;

    

?>