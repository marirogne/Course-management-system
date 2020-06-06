<?php

//Include this file:
include_once './data.php';

class Student {
    
    //Variables for the object
    public $studNo;
    private $fname;
    private $lname;
    private $dob;
    public $coursesPassed;
    public $coursesFailed;
    private $gradeCreditSum;
    public $gpa;
    public $status;

    //Construct funtion
    function __construct($studNo, $fname, $lname, $dob){
        $this->studNo = $studNo;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = $dob;
        $this->coursesPassed = array();
        $this->coursesFailed = array();
        $this->gradeCreditSum = array();
    }
    
    //Function for displaying the student information in a table
    function showStudentInfo(){
        echo '<tr>
            <td>' . $this->studNo . '</td>
            <td>' . $this->fname . '</td>
            <td>' . $this->lname . '</td>
            <td>' . $this->dob . '</td>
            <td>' . $this->coursesPassed . '</td>
            <td>' . $this->coursesFailed . '</td>
            <td>' . $this->gpa . '</td>
            <td>' . $this->status . '</td>
        </tr>';
    }

    /** 
     * Function for setting status on a student.
     * If GPA is between 0 and 1.99, status is unsatisfactory
     * If GPA is between 2 and 2.99, status is satisfactory
     * If GPA is between 3 and 3.99, status is honour
     * If GPA is between 4 and 5, status is high honour
     * @param { int } $gpa -> The GPA of the student
     * @return { string } $status -> The status of the student
    */


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

    /**
     * Function for finding the number of passed students in a course
     * @param { array } $array -> The array from grades.csv
     * @return { int } $sumCoursesPassed -> The number of passed course for the student
     */
    function coursesPassed($array){
        //For each row in the array
        foreach($array as $passed){
            if($passed[0] == $this->studNo && checkGrade($passed[3]) == true){ //If the course code is the one of the object and if the grade is between A and E
                array_push($this->coursesPassed, $passed); //Push the line in the coursesPassed array that was defined in the construct
            }
            
        }
        $sumCoursesPassed = sizeof($this->coursesPassed); //Return the numbers of rows in the coursesPassed array
        return $sumCoursesPassed; //Return the number of rows
    }

    /**
     * Function for finding the number of failed students in a course
     * @param { array } $array -> The array from grades.csv
     * @return { int } $sumCoursesFailed-> The number of failed course for the student
     */
    function coursesFailed($array){
        //For each row in the array
        foreach($array as $failed){
            if($failed[0] == $this->studNo && checkGrade($failed[3]) == false){ //If the course code is the one of the object and if the grade is F
                array_push($this->coursesFailed, $failed); //Push the line in the courseFailed array that was defined in the construct
            }
            
        }
        $sumCoursesFailed = sizeof($this->coursesFailed); //return the number of rows in the coursesFailed array
        return $sumCoursesFailed; //Return number of rows
    }
    
    /**
     * Function for calculating the GPA of the student
     * @param { array } $array -> The array from grades.csv
     * @return { int } $gpa -> The GPA of the student
     */
    function calculateGPA($array) {
        $totalCredits = 0; //Preparing a totalCredits array

        $grades = ["F", "E", "D", "C", "B", "A"]; //An array containing all the possible grades, F is placed first as it is row 0, while A represents row 5
        
        //Find total credits taken
        //for each line in the array
        foreach ($array as $credits) {
            //If the first element in the array is equal to the student number of the object
            if ($credits[0] == $this->studNo) {
                $totalCredits += $credits[2]; //Add the credits to the total credits variable
            }
        }

        //Calculate course_credit x grade
        //For each line in the array
        foreach ($array as $stud) {
            //If the first element in the array is equal to the student number of the object
            if ($stud[0] == $this->studNo) {
                $gradeValue = array_search($stud[3], $grades); //Search for the grade from the array in the grades array and assign it to the variable
                $courseCredit = $stud[2]; //Assign the credits to the temporarily credits variable
                $sumGradeCredit = $gradeValue*$courseCredit; //Gradecredit equals to the value of the grade * the credits of the course
                array_push($this->gradeCreditSum, $sumGradeCredit); //Push this gradecredit to the credits passed array.
            }
        }
        $totalSumGradeCredit = array_sum($this->gradeCreditSum); //Find the total sum in the creditsPassed array
        $gpa = $totalSumGradeCredit / $totalCredits; //Calculate GPA (sum(course_credit x grade) / sum(credits_taken)).
        $gpa = round($gpa, 2);
        return $gpa; //Return the GPA
    }
}




?>