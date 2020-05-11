<?php
    include_once '../html/nav.html';
    //include_once 'Data.php';
    include_once 'data3.php';

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
    if (($fp = fopen('../files/courses.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
            $courseArray[] = $data;
            //$row ++;
        }
        $count = count($courseArray);
        echo "<p>There are <b>$count</b> courses registered.</p>";

        foreach($courseArray as $row){
            $course = new Course($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
                            $course->showCourseInfo();
        }
    }
    echo <<< _END
                </tbody>
            </table>
        </div>

    _END;

?>