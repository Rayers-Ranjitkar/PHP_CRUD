<?php
require"db_connect.php";

$deleteStudentID = $_GET['id']; //confirming that we are receiving the particular clicked "student's id"
echo "$deleteStudentID";

$query = $conn -> prepare("DELETE From school_table WHERE id=? "); #Here, prepare should be a lowercase
$query->execute([$editStudentID] );

//echo "<script>alert('Data Updated successfully!');</script>"; //since, this wasn't being seen another way of redirecting

//Redirecting to the main page, After updating the student
//see below, we can use php code , variables inside HTML and JS code as well 
echo "<script>
        alert('Data deleted successfully! for studentId: $deleteStudentID'); 
        window.location.href='index.php';
      </script>";
//header("Location: index.php"); //header("Location: fileName"); //This redirects to that page
exit(); // always call exit() after header redirect as we need to end this script
    
?>