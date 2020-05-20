<?php

    include_once '../html/nav.html';
    include_once './data3.php';

    class Course {

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


        function __construct($ccode, $name, $year, $semester, $instructor, $credits){
            $this->setCcode($ccode);
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

       //get-functions

        function getCcode(){
            return $this->ccode;
        }

        function getName(){
            return $this->name;
        }

        function getYear(){
            return $this->year;
        }

        function getSemester(){
            return $this->semester;
        }

        function getCredits(){
            return $this->credits;
        }

        function getInstructor(){
            return $this->instructor;
        }


        //Set functions

        function setCcode($ccode){
            return $this->ccode = $ccode;
        }
        
        function setName($name){
            return $this->name = $name;
        }

        function setYear($year){
            return $this->year = $year;
        }

        //Declaring which values are acceptable for the semester
        function setSemester($semester){
            if($semester == "Fall" || $semester == "Spring" || $semester == "Summer"){
                return $this->semester = $semester;
            } else {
                echo "Semester is not valid.";
            }
        }

        //Declaring which values are acceptable for credits
        function setCredits($credits){
            if($credits == 5 || $credits == 7 || $credits == 10){
                return $this->credits = $credits;
           } else {
                echo "Credits are not valid.";
            }
        }

        function setInstructor ($instructor){
            return $this->instructor = $instructor;
        }



        /* function registeredStudents($array){
            $regStud = 0;
            foreach($array as $students){
                if($students[1] == $this->ccode){
                    $regStud ++;    
                }
            
            }
            return $regStud;
        } */

        //function for finding the number of registered students in a course
        function registeredStudents($array){
            //$this->studentsRegistered = array();
            foreach($array as $students){
                if($students[1] == $this->ccode){
                    array_push($this->studentsRegistered, $students);
                    //$regStud ++;    
                }
            
            }
            return sizeof($this->studentsRegistered);
        }

        /* function checkGrade($grade){
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
        } */

        /* function studentsPassed($array){
            $studPassed = 0;
            foreach($array as $passed){
                if($passed[1] == $this->ccode && checkGrade($passed[2]) == true){
                        $studPassed ++;
                }
            }
            return $studPassed;
        } */

        //function for finding the number of passed students in a course
        function studentsPassed($array){
            //$this->studentsPassed = array(); //Preparing the studentsPassed array
            foreach($array as $passed){
                if($passed[1] == $this->ccode && checkGrade($passed[3]) == true){ //If the course code is the one of the object and if the grade is between A and E
                    array_push($this->studentsPassed, $passed); //Push the line in the new array
                }
                
            }
            return sizeof($this->studentsPassed); //return the number of rows in the new array
        }

        /* function studentsFailed($array){
            $studFailed = 0;
            foreach($array as $failed){
                if($failed[1] == $this->ccode && checkGrade($failed[2]) == false){
                        $studFailed ++;
                }
            }
            return $studFailed;
        } */

        //function for finding the number of failed students in a course
        function studentsFailed($array){
            //$this->studentsFailed = array();
            foreach($array as $failed){
                if($failed[1] == $this->ccode && checkGrade($failed[3]) == false){ //If the course code is the one of the object and if the grade is F
                    array_push($this->studentsFailed, $failed); //Push the line in the new array
                }
                
            }
            return sizeof($this->studentsFailed); //return the number of rows in the new array
        }

        /* function gradeToNumber($grade){
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
        } */


        //Function for calculating the average grade in a course
        function avgGrade($array){
            $grades = ['F', 'E', 'D', 'C', 'B', 'A'];
            //$this->avgGrade = array();
            //$tempSum = 0;
            //$tempCount = 0;
            //$avg = '';
                foreach($array as $row){
                    if($row[1] == $this->ccode){
                        
                        //strtoupper($row[3]);
                        //gradeToNumber($avg[3]);
                        //$avg[3] = intval($avg[3]);
                        //$ag += $avg[3];
                        $point = array_search($row[3], $grades);
                        array_push($this->avgGrade, $point);                    
                    }
                }
                if(count($this->avgGrade)){
                    $tempSum = array_sum($this->avgGrade);
                    $tempCount = count($this->avgGrade);

                    $gradeTemp = array_filter($this->avgGrade);
                    $average = $tempSum / $tempCount;
                }
                $avg = $grades[round($average)];
            //$avg = $this->avgGrade;
            //$avg = sizeof($this->avgGrade);
            
            return $avg;
            
        }


    } 



?>