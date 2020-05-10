<?php

    include_once '../html/nav.html';

    class Course {

        private $ccode;
        private $name;
        private $year;
        private $semester;
        private $credits;
        private $instructor;
        private $studentsRegistered;
        private $studentsPassed;
        private $studentsFailed;
        private $avgGrade;


        function __construct($ccode, $name, $year, $semester, $credits, $instructor){
            $this->ccode = $ccode;
            $this->name = $name;
            $this->year = $year;
            $this->setSemester($semester);
            $this->setCredits($credits);
            $this->instructor = $instructor;
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
                <td>' . $this->credits . '</td>
                <td>' . $this->instructor . '</td>
                <td>' . count($this->studentsRegistered) . '</td>
                <td>' . count($this->studentsPassed) . '</td>
                <td>' . count($this->studentsFailed) . '</td>
                <td>' . array_sum($this->avgGrade)/count($this->avgGrade) . '</td>
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
            //if($semester == "Fall" || $semester == "Spring" || $semester == "Summer"){
                return $this->semester = $semester;
            //} else {
            //    echo "Semester is not valid.";
            //}
            
        }

        function setCredits($credits){
            //if($credits == 5 || $credits == 7 || $credits == 10){
                return $this->credits = $credits;
           // } else {
           //     echo "Credits are not valid.";
           // }
        }

        function setInstructor ($instructor){
            return $this->instructor = $instructor;
        }


    }



?>