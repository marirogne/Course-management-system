<?php

    include '../html/nav.html';
    include_once 'StudentClass.php';
    //include_once 'Data.php';
    include_once 'data3.php';

    //$student1 = new student(1, "Mari", "Rogne", 190395);


    //Creating the table for the students:
    echo <<< _END
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Student number</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Birthdate</th>
                        <th>Courses passed</th>
                        <th>Courses failed</th>
                        <th>GPA</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
    _END;
    /* $cData = new Data('../files/update.csv');
    $cData->readCSV('../files/update.csv');
    //$newStudent->showStudentInfo(); */
    
    
    $studArray = array(); //Preparing a student array
    $gradeArray = array(); //Preparing a grade array
    $objectArray = array(); //Preparing an array for all the objects

    //Find the data from the stundets.csv file and place it in the student array
    if (($fp = fopen('../files/students.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
            $studArray[] = $data;
            //$row ++;
        }
        //Find the data from the grades.csv file and place it in the grade array
        if (($grade = fopen('../files/grades.csv', 'r')) !== FALSE) {
            while (($gradedata = fgetcsv($grade, 1000, ",")) !== FALSE) {
                $gradeArray[] = $gradedata;
                //$row ++;
            }
        }
       
        //Go through each line in the student array row
        foreach($studArray as $row){
            $student = new Student($row[0], $row[1], $row[2], date('d-m-Y', $row[3])); //Create a new object
            $student->coursesPassed = $student->coursesPassed($gradeArray); //Find the number of passed courses a students have
            $student->coursesFailed = $student->coursesFailed($gradeArray); //Find the number of failed courses a students have
            $student->gpa = $student->calculateGPA($gradeArray);
            $student->status = $student->setStatus($student->gpa);
            array_push($objectArray, $student);
            //$student->showStudentInfo(); //Display the student info in the table
        }
        
         

        fclose($fp); //Close the link to the students csv-file.
    }
    
    /* function sortStudents($a, $b) {
        if($a->gpa == $b->gpa){ 
            return 0 ; 
        }
        return ($a->gpa > $b->gpa) ? -1 : 1;
    } */
    $objectArray = validateStudentArray($objectArray);
    usort($objectArray, 'sortStudents');
    

   

   /*  function removeDuplicates($array){
        $array = array_map("unserialize", array_unique(array_map("serialize", $array)));
        $array = array_values($array);
        return $array;
    } */
    //$objectArray = validateStudentArray($objectArray);

    $count = count($objectArray); //Count the number of rows int the student array
        echo "<p>There are <b>$count</b> students registered.</p>"; //Display the number of students in the array
        
    foreach($objectArray as $object){
        $object->showStudentInfo();
    }

    //Finish the table structure in HTML          
    echo <<< _END
                </tbody>
            </table>
        </div>

    _END;

    

?>