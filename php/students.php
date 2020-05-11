<?php

    include '../html/nav.html';
    include_once 'StudentClass.php';
    //include_once 'Data.php';
    include_once 'data3.php';

    //$student1 = new student(1, "Mari", "Rogne", 190395);


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
    $studArray = array();
   
    if (($fp = fopen('../files/students.csv', 'r')) !== FALSE) {
        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
            $studArray[] = $data;
            //$row ++;
        }
        $count = count($studArray);
        echo "<p>There are <b>$count</b> students registered.</p>";
        foreach($studArray as $row){
            $student = new Student($row[0], $row[1], $row[2], date('d-m-Y', $row[3]));
                            $student->showStudentInfo();
        }
        
        

        fclose($fp);
    }
    

   /*  function removeDuplicates($array){
        $array = array_map("unserialize", array_unique(array_map("serialize", $array)));
        $array = array_values($array);
        return $array;
    } */


                    
    echo <<< _END
                </tbody>
            </table>
        </div>

    _END;

    

?>