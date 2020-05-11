<?php

    include '../html/nav.html';
    include_once 'StudentClass.php';
    //include_once 'Data.php';
    include_once 'data3.php';

    $student1 = new student(1, "Mari", "Rogne", 190395);

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
    
                    
    echo <<< _END
                </tbody>
            </table>
        </div>

    _END;

    
    

?>