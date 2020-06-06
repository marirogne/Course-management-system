# Obligatory assignment 1

Launching:

- Save the folder inside the htdocs folder in XAMPP
- Run XAMPP
- Open index.html in browser

For testing, upload the input.csv file. 
If you will be making your own input file, you have to use this format:

Studentnumber,firstname,lastname,dateofbirth(yyyy-mm-dd),coursecode,coursename,year,semester,courseresponsible,credits,grade

The assignment description for uploading data was:

"The third php file is named ’data.php’ and should allow you to upload new data from a file.
Each line in the input file should include: student number, student name, student surname,
student birthdate, course code, course year, course semester, instructor name, number of
credits, and grade."

For this assignment, I have created a file named upload.php which contains the form for uploading data,
however, it is the data.php file which contains the php code which allows for uploading and updatating the csv files. I have
interpreted that this is a correct method for this.

When uploading new input for the database, the user write the date of birth in the format yyyy-mm-dd, which will be converted
and saved as unix timestamp when uploaded to the database. This date will again be converted back to the original format when
displayed on the website.