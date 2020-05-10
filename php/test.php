<?php
require_once 'StudentClass.php';
require_once 'Course.php';
require_once 'Data.php';
/* 
$student = new Student(41, "Mari", "Rogne", 1903951995);
$student->studNo = 41;
$student->fname = "Mari";
$student->lname = "Rogne";
$student->dob = 19031995; 

echo $student->fname; */

$student = new Student(41, 'Mari', 'Rogne', 19031995);
Echo $student->getfname() . "<br>";

$course = new Course("IMT1010", "Webprojects 2", 2020, "Spring", 10, "Carlos");
$course1 = new Course("IMT1110", "Webprojects 3", 2021, "Fall", 5, "Carlos");
echo "<table border=1px><tr>" . $course->showCourseInfo() . "</tr>";
echo "<tr>" . $course1->showCourseInfo() . "</tr></table>";



?>