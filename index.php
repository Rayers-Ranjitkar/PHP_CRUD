<?php 
include 'header.php';

//Displaying the database's table
require 'db_connect.php';
$query1 = $conn->prepare("SELECT * FROM school_table"); //$conn stores a PDO object after db_connect runs and in $query1 too there is now object
//Prepare returns a PDOStatement object, which we store in $query1.
$query1->execute(); //'execute' is the method of PDOStatement Object
$students = $query1->fetchAll(PDO::FETCH_ASSOC); //fetchAll() takes all the rows returned by your query and puts them into an array. //PDO::FETCH_ASSOC means fetch each row is an associative array (column name → value). //PDO::FETCH_ASSOC tells PHP how we want to receive the results.

//Since, we are fetching it as associative array, this is the data we get as
// $students = [
//     ['id'=>1, 'name'=>'Ram', 'email'=>'ram@gmail.com', 'age'=>15],
//     ['id'=>2, 'name'=>'Sita', 'email'=>'sita@gmail.com', 'age'=>16]
// ];

?>

<Html>
    <p><a href="addStudent.php">Add Student</a> </p>

     <h2>Students Table: </h2>
     <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Action</th>
        </tr>

            <?php
            if(!empty($students)) {
                foreach($students as $student) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($student['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($student['name']) . "</td>"; //htmlspecialchars() → treats html tags as text i.e. makes sure special characters don’t break HTML (important for security). //$text = "<b>Ram</b>";  //echo htmlspecialchars($text); //Output in browser: <b>Ram</b> //else, just Ram aauthiyo in bold letters
                    echo "<td>" . htmlspecialchars($student['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($student['age']) . "</td>";
                    
                    // Action column with Edit and Delete links
                    echo "<td>"; //i.e. inside 4th table data <td>
                    echo "<a href='edit.php?id=" . $student['id'] . "'>Edit</a> "; //storing the student's id as our query paramter as when we send this data to the backend aka server, it should know which student data to delete or update right
                    echo "<a href='delete.php?id=" . $student['id'] . "'>Delete</a>";
                    echo "</td>";

                    echo "</tr>";
                }
                //echo "DEBUG: Student ID = " . $student['id'] . "<br>";
            } else {
                echo "<tr><td colspan='3'>No students found.</td></tr>";
            }
        ?>

    </table>

</HTML>


<?php
include 'footer.php'
?>