
<?php
require "db_connect.php";

$editStudentID = $_GET['id']; //confirming that we are receiving the particular clicked "student's id"
// echo "$editStudentID";

// if(isset($_GET['id']) && !empty($_GET['id'])) {
//     $editStudentID = $_GET['id'];
//     echo "Student ID: $editStudentID";
// } else {
//     echo "No student ID provided!";
// }

//$query = $conn -> PREPARE("INSERT INTO school_table(name,email,age) VALUES(?,?,?) WHERE id='1' ") //Insert into is for adding new rows not for modifying them
if(isset($_POST['submit'] )){ //POST superGlobal array = ( [name] => Rayers , [email] => ramesh@gmail.com....  [submit] => submit_btn_was_clicked) //that is only set when submit button is clicked //hmm nice so, we want to run this only when the button is clicked
    //Get new data 
    $newName = $_POST['nameNew'];
    $newEmail = $_POST['emailNew'];
    $newAge = (int) $_POST['ageNew'];

    //validating form data.............................................................................
    include "formValidation.php"; //making the code modular

    //Checking if input fields are empty
    if(empty($newName) || empty($newEmail) || empty($newAge)){
        die("<script>alert('All fields are required!');</script>");
    }

    $newName = formatName($newName);

    if(!validateEmail($newEmail)){
         die("<script>alert('Invalid email address! Atleast 1 @ or . is required.');</script>");
    }

    if(!validateAge($newAge)){
        die("<script>alert('Age cannot be less than 0');</script>");
    }
    //.....................Preparing and updating the old data...............................................
    
    $query = $conn -> PREPARE("UPDATE school_table 
                            SET name=?, email=?, age=?
                            WHERE id=?");

    $query->execute([$newName, $newEmail, $newAge, $editStudentID]);

     echo "<script>alert('Data Updated successfully!');</script>";

     //Redirecting to the main page, After updating the student
    header("Location: index.php"); //header("Location: fileName"); //This redirects to that page
    exit(); // always call exit() after header redirect as we need to end this script
    }
  ?>



<HTML>
    <head>
        <title>Edit Students Info</title>
    </head>

    <h2>Enter new student details for Student id: <?php echo $editStudentID; ?> </h2>

    <form action="" method="post">
        <label>Name: </label><br>
        <input placeholder="Name" name='nameNew'></br></br>

        <label>Email: </label><br>
        <input placeholder="Email" name='emailNew'></br></br>

        <label>Age: </label><br>
        <input placeholder="Age" name='ageNew'></br></br>

        <button type="submit" name="submit" value="submit_btn_was_clicked">Submit </button> <!-- this thing in value we get in the $_POST['submit'] -->
    <form>
</HTML>
