<?php
    include_once '../html/nav.html';
    //include_once 'Data.php';
    include_once 'data3.php';
    include_once 'Course.php';


    //Create the table structure
    echo <<< _END
        <div class = "content">    
            <table>
                <thead>
                    <tr>
                        <th>Course code</th>
                        <th>Course name</th>
                        <th>Year</th>
                        <th>Semester</th>
                        <th>Instructor</th>
                        <th>Credits</th>
                        <th>Registered students</th>
                        <th>Students passed</th>
                        <th>Students failed</th>
                        <th>Average grade</th>
                    </tr>
                </thead>
                <tbody>
    _END;
    
    
    $courseArray = array(); //Preparing a course array
    $gradeArray = array();  //Preparing a grade array
    $objectArray = array(); //Preparing an array for all the objects

    //Find the data from the stundets.csv file and place it in the student array
    if (($course = fopen('../files/courses.csv', 'r')) !== FALSE) {
        while (($coursedata = fgetcsv($course, 1000, ",")) !== FALSE) {
            $courseArray[] = $coursedata;
            //$row ++;
        }
        //Find the data from the grades.csv file and place it in the grade array
        if (($grade = fopen('../files/grades.csv', 'r')) !== FALSE) {
            while (($gradedata = fgetcsv($grade, 1000, ",")) !== FALSE) {
                $gradeArray[] = $gradedata;
                //$row ++;
            }
        }
        /* $uniqueCourses = uniqueRows($courseArray);
                    update($uniqueCourses, '../files/courses.csv', 'w'); */
        $count = count($courseArray); //Count the number of rows int the course array
        echo "<p>There are <b>$count</b> courses registered.</p>"; //Display the number of courses in the array

        //Go through each line in the course array row
        foreach($courseArray as $row){
            $course = new Course($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]); //Create a new object
            $course->studentsRegistered = $course->registeredStudents($gradeArray);  //Find the number of registred students in the course
            $course->studentsPassed = $course->studentsPassed($gradeArray);  //Find the number of passed students in the course
            $course->studentsFailed = $course->studentsFailed($gradeArray);  //Find the number of failed students in the course
            $course->avgGrade = $course->avgGrade($gradeArray);
            //$course->showCourseInfo();  //Display the course info in the table
            array_push($objectArray, $course);
        }
        //ksort($objectArray, $course->studentsRegistered);

       /*  function sort2($a, $b) {
            if($a->studentsRegistered == $b->studentsRegistered){ return 0 ; }
            return ($a->studentsRegistered < $b->studentsRegistered) ? -1 : 1;
        } */

        //sort2($objectArray, $course);

        // sort alphabetically by name
        //usort($objectArray, 'compare_lastname');


        /* function sorting($a, $b){
            if($a[$row[6]] == $b[$row[6]]) {
            }

            $cmpa = array_search($a[$row[6]], $objectArray);
            $cmpb = array_search($b[$row[6]], $objectArray);
            return ($cmpa > $cmpb) ? 1 : -1;
        }
        asort($objectArray, 'sorting'); */
        //$courseArray->asort();
        //fclose($grade);
        //fclose($course);
        
    }

     /* function sortCourses($a, $b){
        foreach($objectArray as $row){
            return strnatcmp($a['studentsRegistered'], $b['studentsRegistered']);
        }
    } */


    //Tutorial from https://davidwalsh.name/sort-objects
    function sortCourses($a, $b) {
        if($a->studentsRegistered == $b->studentsRegistered){ 
            return 0 ; 
        }
        return ($a->studentsRegistered < $b->studentsRegistered) ? -1 : 1;
    }

    //Usort = sorting an array through a user-defined comparison function
    usort($objectArray, 'sortCourses'); //Sort the table by using the sortCourses function

    // sort alphabetically by name
    //asort($objectArray, 'compare_lastname');
    //sort($objectArray[6]);

    foreach($objectArray as $object){
        $object->showCourseInfo();
    }
    //echo $objectArray;
    


  /*   function compare($x, $y){
        return strnatcmp($x[$course->studentsRegistered], $y[$course->studentsRegistered]);
    }
 */
   // uasort($courseArray, 'compare');
    
    
    /* function comparator($object1, $object2) { 
        return $object1->score > $object2->score; 
    } */
    
    //Finish the table structure in HTML   
    echo <<< _END
                </tbody>
            </table>
        </div>

    _END;

?>