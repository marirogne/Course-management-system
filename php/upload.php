<?php
    include '../html/nav.html';
    include 'data3.php';
    
    

    echo <<< _END
    <div class ="content">
        <p>On this page you will be allowed to upload a file to update the tables. Only CSV-files are allowed. Please give the following information:</p>
            <ul class ="infolist">
                <li>Student number</li>
                <li>Student name</li>
                <li>Student surname</li>
                <li>Student birthdate</li>
                <li>Course code</li>
                <li>Course year</li>
                <li>Course semester</li>
                <li>Instructor name</li>
                <li>Number of credits</li>
                <li>Grade</li>
            </ul>
        <br> <br> 
    _END;

    //require_once 'Data.php';

    echo <<< _END
            <form method='post' action='upload.php' enctype='multipart/form-data'>
                Select file: <input type = 'file' name = 'filename' size = '10'>
                <input type='submit' value = 'Upload' name='upload'>
            </form>
        </div>
    _END;

    /* $update = new Data('../files/update.csv');
    echo $update->csvToArray('../files/students.csv');
 */
    

?>