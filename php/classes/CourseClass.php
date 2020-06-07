<?php

//Include this file:
include_once './data.php';

class Course {

    //Variables for the object
    private $ccode;
    private $name;
    private $year;
    private $semester;
    private $instructor;
    private $credits;
    public $studentsRegistered;
    public $studentsPassed;
    public $studentsFailed;
    public $avgGrade;

    //Construct funtion
    function __construct($ccode, $name, $year, $semester, $instructor, $credits){
        $this->ccode = $ccode;
        $this->name = $name;
        $this->year = $year;
        $this->setSemester($semester);
        $this->instructor = $instructor;
        $this->setCredits($credits);
        $this->studentsRegistered = array();
        $this->studentsPassed = array();
        $this->studentsFailed = array();
        $this->avgGrade = array();
    }

    //Function for displaying the course information in a table
    function showCourseInfo(){
        echo '<tr>
            <td>' . $this->ccode . '</td>
            <td>' . $this->name . '</td>
            <td>' . $this->year . '</td>
            <td>' . $this->semester . '</td>
            <td>' . $this->instructor . '</td>
            <td>' . $this->credits . '</td>
            <td>' . $this->studentsRegistered . '</td>
            <td>' . $this->studentsPassed . '</td>
            <td>' . $this->studentsFailed . '</td>
            <td>' . $this->avgGrade . '</td>
        </tr>';
    }

    /**
     * Declaring which values are acceptable for the semester
     * @param { string } $semester -> The semester in the object
     * @return { string } $this->semester = $semester -> The semester of the object
     */
    function setSemester($semester){
        if($semester == "Fall" || $semester == "Spring" || $semester == "Summer"){
            return $this->semester = $semester;
        } else {
            echo "Semester is not valid.";
        }
    }

    /**
     * Declaring which values are acceptable for credits
     * @param { int } $credits -> The credits in the object
     * @return { int } $this->credits = $credits -> The credits in the object
     */
    function setCredits($credits){
        if($credits == 5 || $credits == 7 || $credits == 10){
            return $this->credits = $credits;
        } else {
            echo "Credits are not valid.";
        }
    }

    /**
     * Function for finding the number of registered students in a course
     * @param { array } $array -> To place the grade array
     * @return { int } $sumRegisteredStudents -> The number of registered students in the course
     */
    function registeredStudents($array){
        //For each line in the array
        foreach($array as $students){
            //If the second element in the array equals to the ccode of the object
            if($students[1] == $this->ccode){
                array_push($this->studentsRegistered, $students); //Push the line into the studentsRegistered array   
            }
        
        }
        $sumRegisteredStudents = sizeof($this->studentsRegistered); //Define the number of rows in the studentsRegistered array as a variable
        return $sumRegisteredStudents; //Return the number of rows
    }

    /**
     * Function for finding the number of passed students in a course
     * @param { array } $array -> To place the grade array
     * @return { int } $sumStudentsPassed -> The number of students who passed in the course
     */
    function studentsPassed($array){
        foreach($array as $passed){
            //If the course code is the one of the object and if the grade is between A and E
            if($passed[1] == $this->ccode && checkGrade($passed[3]) == true){ 
                array_push($this->studentsPassed, $passed); //Push the line into the studentsPassed array
            }
        }
        $sumStudentsPassed = sizeof($this->studentsPassed); //return the number of rows in the studentsPassed array
        return $sumStudentsPassed; //Return the number of rows
    }

    /**
     * Function for finding the number of failed students in a course
     * @param { array } $array -> To place the grade array
     * @return { int } $sumStudentsFailed -> The number of students who failed in the course
     */
    function studentsFailed($array){
        foreach($array as $failed){
            //If the course code is the one of the object and if the grade is F
            if($failed[1] == $this->ccode && checkGrade($failed[3]) == false){ 
                array_push($this->studentsFailed, $failed); //Push the line into the studentsFailed array
            }
            
        }
        $sumStudentsFailed = sizeof($this->studentsFailed); //return the number of rows in the studentsFailed array
        return $sumStudentsFailed; //Return the number of rows
    }

    /**
     * Function for calculating the average grade in a course
     * @param { array } $array -> To place the grade array
     * @return { string } $avg -> The average grade formed as a string
     */
    function avgGrade($array){
        $grades = ['F', 'E', 'D', 'C', 'B', 'A']; //An array containing all the possible grades, F is placed first as it is row 0, while A represents row 5

        //For each line in the array
        foreach($array as $row){
            //If the second element in the array is equal to the course code of the object
            if($row[1] == $this->ccode){
                $gradeValue = array_search($row[3], $grades); //Search for the grade from the array in the grades array and assign it to the variable
                array_push($this->avgGrade, $gradeValue); //Push the gradeValue to the avgGrade array                   
            }
        }
        //If count the avgGrade array
        if(count($this->avgGrade)){
            $sum = array_sum($this->avgGrade); //Make a temparay sum variable that is the sum of the avgGrade array
            $count = count($this->avgGrade); //Make a temporary count of all the grades in the avgGrade array
            $average = $sum / $count; //Average is the tempsum variable divided on tempcount variable
        }
        $avg = $grades[round($average)]; //Avg equals to the (rounded)average grade in the grades array
        
        return $avg; //Return avg   
    }
} 



?>