<?php
include_once '../html/nav.html';
include_once 'data3.php';
include_once 'Course.php';

$courseArray = array(); //Preparing a course array
$gradeArray = array();  //Preparing a grade array
$objectArray = array(); //Preparing an array for all the objects

//Find the data from the stundets.csv file and place it in the student array
if (($courseCSV = fopen('../files/courses.csv', 'r')) !== FALSE) {
    while (($coursedata = fgetcsv($courseCSV, 1000, ",")) !== FALSE) {
        $courseArray[] = $coursedata;
    }
    //Find the data from the grades.csv file and place it in the grade array
    if (($grade = fopen('../files/grades.csv', 'r')) !== FALSE) {
        while (($gradedata = fgetcsv($grade, 1000, ",")) !== FALSE) {
            $gradeArray[] = $gradedata;
        }
    }

    //Go through each line in the course array row
    foreach($courseArray as $row){
        $course = new Course($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]); //Create a new object
        $course->studentsRegistered = $course->registeredStudents($gradeArray);  //Find the number of registred students in the course
        $course->studentsPassed = $course->studentsPassed($gradeArray);  //Find the number of passed students in the course
        $course->studentsFailed = $course->studentsFailed($gradeArray);  //Find the number of failed students in the course
        $course->avgGrade = $course->avgGrade($gradeArray);
        array_push($objectArray, $course);
    }
    fclose($courseCSV); //Close the link to the students csv-file.
}

usort($objectArray, 'sortCourses'); //Sort the table by using the sortCourses function
$count = count($courseArray); //Count the number of rows int the course array
echo "<p>There are <b>$count</b> courses registered.</p>"; //Display the number of courses in the array


//Create the table structure
echo <<< _END
<div class = "content">    
    <table>
        <thead>
            <tr>
                <th>Course code</th>
                <th>Course name</th>
                <th>Year</th>
                <th>Semester</th>
                <th>Instructor</th>
                <th>Credits</th>
                <th>Registered students</th>
                <th>Students passed</th>
                <th>Students failed</th>
                <th>Average grade</th>
            </tr>
        </thead>
        <tbody>
_END;

foreach($objectArray as $object){
    $object->showCourseInfo();
}

//Finish the table structure in HTML   
echo <<< _END
            </tbody>
        </table>
    </div>

_END;

?>