<?php

    include_once '../html/nav.html';

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

        function setCcode($ccode){
            return $this->ccode = $ccode;
        }
        
        function setName($name){
            return $this->name = $name;
        }

        function setYear($year){
            return $this->year = $year;
        }

        function setSemester($semester){
            if($semester == "Fall" || $semester == "Spring" || $semester == "Summer"){
                return $this->semester = $semester;
            } else {
                echo "Semester is not valid.";
            }
            
        }

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

        function registeredStudents($array){
            $this->studentsRegistered = array();
            foreach($array as $students){
                if($students[1] == $this->ccode){
                    array_push($this->studentsRegistered, $students);
                    //$regStud ++;    
                }
            
            }
            return sizeof($this->studentsRegistered);
        }

        function checkGrade($grade){
            switch ($grade) {
                case ' A':
                case ' B':
                case ' C':
                case ' D':
                case ' E':
                    return true;
                    break;
                case ' F':
                    return false;
                    break;
            }
        }

        /* function studentsPassed($array){
            $studPassed = 0;
            foreach($array as $passed){
                if($passed[1] == $this->ccode && checkGrade($passed[2]) == true){
                        $studPassed ++;
                }
            }
            return $studPassed;
        } */
        function studentsPassed($array){
            $this->studentsPassed = array();
            foreach($array as $passed){
                if($passed[1] == $this->ccode && checkGrade($passed[2]) == true){
                    array_push($this->studentsPassed, $passed);
                }
                
            }
            return sizeof($this->studentsPassed);
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
        function studentsFailed($array){
            $this->studentsFailed = array();
            foreach($array as $failed){
                if($failed[1] == $this->ccode && checkGrade($failed[2]) == false){
                    array_push($this->studentsFailed, $failed);
                }
                
            }
            return sizeof($this->studentsFailed);
        }

        function gradeToNumber($grade){
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
        }

        function avgGrade($array){
            $this->avgGrade = array();
                foreach($array as $avg){
                    if($avg[1] == $this->ccode){
                        strtoupper($avg[2]);
                        gradeToNumber($avg[2]);
                        array_push($this->avgGrade, $avg[2]);                    
                    }
                }
            $avg = array_sum($this->avgGrade);
            //$avg = sizeof($this->avgGrade);
            
            return $avg;
            
        }




    } 



?>