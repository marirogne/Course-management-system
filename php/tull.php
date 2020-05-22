<?php

    require_once 'StudentClass.php';
    require_once 'Course.php';
    

    class Data{

        private $sArray;
        private $cArray;

        function __construct($files){
            $this->sArray = array();
            $this->cArray = array();
            $this->readCSV($files);
        }

        
        /* if(isset($_POST['upload'])){
            if(isset($_FILES['filename'])){

            }
        } */


        //Function for updating the CSV-file when a user uploads a new file
        function csvToArray($filesName){
            if(isset($_FILES['filename'])) {
                
                $fname = $_FILES["filename"]["name"];
                $ftemp = $_FILES["filename"]["tmp_name"];
                $extension = pathinfo($fname, PATHINFO_EXTENSION);
                        if ($extension != 'csv'){
                            $response = array(
                                "Type" => "Error: ",
                                "Message" => "NB!!! Only CSV-files are allowed!<br> <br>"

                            );
                            echo implode($response);
                        } else {
                             $lengthArray = array();
                            $row = 1;
                            if (($fp = fopen($_FILES["filename"]["tmp_name"], "r")) !== FALSE) {
                                while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
                                    $lengthArray[] = $data;
                                    $row ++;
                                }


                                $studArr = array();
                                $studCsv = studArrayFromFile('../files/students.csv');
                                if (count($studCsv) != 0) {
                                    foreach($studCsv as &$cStud) {
                                        array_push($studArr, $cStud);
                                    }
                                }
                                foreach($arr as &$stud) {
                                    array_push($studArr, array($stud[0], $stud[1], $stud[2], $stud[3]));
                                }
                                return $studArr;
                                /* if (count($studArr) == 1) {
                                    $response = array (
                                        "type" => "Success: ",
                                        "message" => "File validation success."
                                    );  */
                                 $filepath = '../files/students.csv';
                                $current = file_get_contents($filepath);
                                $current .= "\n" . file_get_contents($studArr);
    
                                file_put_contents('../files/students.csv', $current)
                                fclose($fp);
                            }



                            $lengthArray = array_unique($lengthArray);
                            if (count($lengthArray) == 1) {
                                $response = array (
                                    "type" => "Success: ",
                                    "message" => "File validation success."
                                ); 
                             $filepath = '../files/update.csv';
                            $current = file_get_contents($filepath);
                            $current .= "\n" . file_get_contents($ftemp);

                            file_put_contents('../files/update.csv', $current);
                            echo "Hooray, you have updated the table!<br>";
                             } else {
                                $response = array(
                                    "type" => "Error: ",
                                    "message" => "Invalid CSV."
                                );
                            }
                        }
            }   
        } 
        
        //Function for reading the CSV-file
        function readCSV($filesname){
            
            //foreach ($filename as $file){
                
               // foreach($filesname as $filename){
                    $file = array_map('str_getcsv', file($filesname));
                    foreach($file as $row){
                        if($row < 4){
                        $newstudent = new Student ($row[0], $row[1], $row[2], $row[3]);
                        $newstudent->showStudentInfo($row[0], $row[1], $row[2], $row[3]);
                        } elseif($row > 3){
                        $newcourse = new Course ($row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);
                        $newcourse->showCourseInfo($row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);
                        }
                    if($courseCode == -1){
                        array_push($this->cArray, $newCourse);
                        
                    }

                    }

                    
                    //echo $newstudent->showStudentInfo($row[0], $row[1], $row[2], $row[3]);
                    $this->sArray[$newstudent-> getStudNo()] = $newstudent;
                    $this->cArray[$newcourse-> getCcode()] = $newcourse;
                    //echo $newcourse->showCourseInfo($row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);
                        /* foreach ($newstudent as $student){
                            array_push($this->getsArray(), $student);                            
                            
                        }
                        foreach($newcourse as $course){
                            array_push($this->getcArray(), $course);
                            
                        } */

                //}
            //}


        }

        //Get- and set-functions
        function getsArray(){
            return $this->sArray;
        }

        function getcArray(){
            return $this->cArray;
        }

        function setsArray($sArray){
            return $this->sArray = $sArray;
        }

        function setcArray($cArray){
            return $this->cArray = $cArray;
        }



        //Function for checking whether the grade is a passed or a failed grade
        function checkGrade($grade){
            switch ($grade) {
                case 'A':
                case 'B':
                case 'C':
                case 'D':
                case 'E':
                    return true;
                case 'F':
                    return false;
            }
            /* if ($grade = 'A' || $grade = 'B' || $grade = 'C' || $grade = 'D' || $grade = 'E'){
                return true;
            } else if ($grade = 'F'){
                return false;
            } */
        }

        //Function for converting the letter-grade to the grade in number.

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
        }


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

  
    }

?>