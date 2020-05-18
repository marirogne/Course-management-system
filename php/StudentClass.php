<?php
    
    include_once '../html/nav.html';
    include_once './data3.php';

    class Student {
        
        private $studNo;
        private $fname;
        private $lname;
        private $dob;
        public $coursesPassed;
        private $creditsPassed;
        public $coursesFailed;
        private $creditsFailed;
        private $gpa;
        private $status;


        function __construct($studNo, $fname, $lname, $dob){
            $this->studNo = $studNo;
            $this->fname = $fname;
            $this->lname = $lname;
            $this->dob = $dob;
            $this->coursesPassed = array();
            $this->creditsPassed = array();
            $this->coursesFailed = array();
            $this->creditsFailed = array();

        }
        
        function showStudentInfo(){
            echo '<tr>
                <td>' . $this->studNo . '</td>
                <td>' . $this->getFname() . '</td>
                <td>' . $this->getLname() . '</td>
                <td>' . $this->getDOB() . '</td>
                <td>' . $this->coursesPassed . '</td>
                <td>' . $this->coursesFailed . '</td>
                <td>' . $this->getGPA() . '</td>
                <td>' . $this->getStatus(2) . '</td>
           </tr>';
        }


        //get-functions: 

        function getStudNo(){
           return $this->studNo;
        }

        function getFname(){
            return $this->fname;
        }

        function getLname(){
            return $this->lname;
        }

        function getDOB(){
            return $this->dob;
        }

        function getCoursesPassed(){
            return $this->coursesPassed;
        }

        function getCoursesFailed(){
            return $this->coursesFailed;
        }

        function getCreditsPassed(){
            return $this->creditsPassed;
        }

        function getCreditsFailed(){
            return $this->creditsFailed;
        }

        function getGPA(){
            return $this->gpa;
        }

        function getStatus(){
            return $this->status;
        }


        //set-functions:

        function setStudNo($studNo){
            return $this->studNo = $studNo;
        }

        function setFname($fname){
            return $this->fname = $fname;
        }

        function setLname($lname){
            return $this->lname = $lname;
        }

        function setDOB($dob){
            return $this->dob = $dob;
        }

        function setCoursesPassed($coursesPassed){
            return $this->coursesPassed = $coursesPassed;
        }

        function setCoursesFailed($coursesFailed){
            return $this->CoursesFailed = $coursesFailed;
        }

        function setCreditsPassed($creditsPassed){
            return $this->creditsPassed = $creditsPassed;
        }

        function setCreditsFailed($creditsFailed){
            return $this->creditsFailed = $creditsFailed;
        }

        function setGPA($gpa){
            return $this->gpa = $gpa;
        }

        /* function setStatus($status){
            if ($status == "Unsatisfactory" || $status == "Satisfactory" || $status == "Honour" || $status == "High honour"){
                $this->status = $status;
            } else {
                echo "Status not set.";
            } */
                
        
         //Function for checking whether the grade is a passed or a failed grade
         /* function checkGrade($grade){
            switch ($grade) {
                case 'A':
                case 'B':
                case 'C':
                case 'D':
                case 'E':
                    return true;
                case 'F':
                    return false;
            } */
            /* if ($grade = 'A' || $grade = 'B' || $grade = 'C' || $grade = 'D' || $grade = 'E'){
                return true;
            } else if ($grade = 'F'){
                return false;
            } */
        //}

        //Function for converting the letter-grade to the grade in number.

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
            } */
            /* if ($grade='A'){
                return 5;
            } else if ($grade='B'){
                return 4;
            } else if ($grade='C'){
                return 3;
            } else if ($grade='D'){
                return 2;
            } else if ($grade='E'){
                return 1;
            } else if ($grade='F') {
                return 0;
            } */
        //}


        //Function for setting status on a student.

        function setStatus($gpa){
            if ($gpa >=0 && $gpa <=1.99){
                $status = "Unsatisfactory";
                return $status;
            } else if ($gpa >=2 && $gpa <=2.99){
                $status = "Satisfactory";
                return $status;
            } else if ($gpa >=3 && $gpa <=3.99){
                $status = "Honour";
                return $status;
            } else if($gpa >=4 && $gpa <=5){
                $status = "High honour";
                return $status;
            }
        }

        //function for finding the number of passed students in a course
        function coursesPassed($array){
            $this->coursesPassed = array(); //Preparing the studentsPassed array
            foreach($array as $passed){
                if($passed[0] == $this->studNo && checkGrade($passed[3]) == true){ //If the course code is the one of the object and if the grade is between A and E
                    array_push($this->coursesPassed, $passed); //Push the line in the new array
                }
                
            }
            return sizeof($this->coursesPassed);
        }

        //function for finding the number of failed students in a course
        function coursesFailed($array){
            $this->coursesFailed = array();
            foreach($array as $failed){
                if($failed[0] == $this->studNo && checkGrade($failed[3]) == false){ //If the course code is the one of the object and if the grade is F
                    array_push($this->coursesFailed, $failed); //Push the line in the new array
                }
                
            }
            return sizeof($this->coursesFailed); //return the number of rows in the new array
        }
       
        function calculateGPA($array){

        }


    }
    

    

?>