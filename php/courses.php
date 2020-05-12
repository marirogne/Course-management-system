<?php
    include_once '../html/nav.html';
    //include_once 'Data.php';
    include_once 'data3.php';
    include_once 'Course.php';

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
    $courseArray = array();
    $gradeArray = array();

    
    if (($course = fopen('../files/courses.csv', 'r')) !== FALSE) {
        while (($coursedata = fgetcsv($course, 1000, ",")) !== FALSE) {
            $courseArray[] = $coursedata;
            //$row ++;
        }
        if (($grade = fopen('../files/grades.csv', 'r')) !== FALSE) {
            while (($gradedata = fgetcsv($grade, 1000, ",")) !== FALSE) {
                $gradeArray[] = $gradedata;
                //$row ++;
            }
        }
        /* $uniqueCourses = uniqueRows($courseArray);
                    update($uniqueCourses, '../files/courses.csv', 'w'); */
        $count = count($courseArray);
        echo "<p>There are <b>$count</b> courses registered.</p>";

        foreach($courseArray as $row){
            $course = new Course($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
            $course->studentsRegistered = $course->registeredStudents($gradeArray);
            $course->studentsPassed = $course->studentsPassed($gradeArray);
            $course->studentsFailed = $course->studentsFailed($gradeArray);
            $course->avgGrade = $course->avgGrade($gradeArray);
            $course->showCourseInfo();
        }
        echo $course->avgGrade;
    }
    echo <<< _END
                </tbody>
            </table>
        </div>

    _END;

?>