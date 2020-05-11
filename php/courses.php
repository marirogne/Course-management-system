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
        /* $cData = new Data('../files/update.csv');
        echo $cData->readCSV('../files/update.csv');
        //$newCourse->showCourseInfo(); */
    echo <<< _END
                </tbody>
            </table>
        </div>

    _END;

?>