<?php
    
    include_once '../html/nav.html';

    class Student {
        
        private $studNo;
        private $fname;
        private $lname;
        private $dob;
        private $coursesPassed;
        private $creditsPassed;
        private $coursesFailed;
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
                <td>' . $this->getStudNo() . '</td>
                <td>' . $this->getFname() . '</td>
                <td>' . $this->getLname() . '</td>
                <td>' . $this->getDOB() . '</td>
                <td>' . count($this->getCoursesPassed()) . '</td>
                <td>' . count($this->getCoursesFailed()) . '</td>
                <td>' . $this->getGPA() . '</td>
                <td>' . $this->getStatus() . '</td>
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

        function setStatus($status){
            if ($status == "Unsatisfactory" || $status == "Satisfactory" || $status == "Honour" || $status == "High honour"){
                $this->status = $status;
            } else {
                echo "Status not set.";
            }
                
        }



    }

    

?>