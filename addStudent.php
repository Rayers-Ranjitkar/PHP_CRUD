<?php 
include 'header.php';

require 'db_connect.php'; //as we need to first connect to the database to insert

//-------------------------------Custom Functions for form validation..................................
if(isset($_POST['submit'] )){ //$_POST returns true if there is some value in $POST['submit']

    function formatName($name) {
        return trim($name); 
    }   

    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false; //!== false as when filter_var finds correct email, it returns string and not true
    }

    function validateAge($age){
        if($age<0){
            return false;
        }else{
            return true;
        }
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = (int) $_POST['age'];  //type-casting string to interger

    //Checking if input fields are empty
    if(empty($name) || empty($email) || empty($age)){
        die("<script>alert('All fields are required!');</script>");
    }

    $name = formatName($name);

    if(!validateEmail($email)){
         die("<script>alert('Invalid email address! Atleast 1 @ or . is required.');</script>");
    }

    if(!validateAge($age)){
        die("<script>alert('Age cannot be less than 0');</script>");
    }

    //--------------------------storing the form data to the database-----------------------
     // Prepare SQL insert statement
    // $query = $conn->prepare("INSERT INTO school_table (name, email, age) VALUES ($name, $email, $age)"); //Database treated the vlaues ($name, $email, $age) as sql
        $query = $conn->prepare("INSERT INTO school_table (name, email, age) VALUES (?, ?, ?)"); //we are telling the database to treat is as a value and not php code to execute //How placeholders ? or :name fix it ---> The database does not treat the data as SQL code. It treats it strictly as values to insert, so quotes, special characters, @, etc., are all handled automatically.
    //$conn->exec($query);  //Takes a full SQL string as input. // Executes it directly on the database.
        //$query->execute(); //ani execute garda we need to pass an array
        $query->execute([$name,$email, $age] ); //due to ? -> The database does not treat the data as SQL code. It treats it strictly as values to insert so we are passing the values to insert here

    echo "<script>alert('Form submitted succesfully successfully!');</script>";

    //Redirecting to the main page, After adding the student data
    header("Location: index.php"); //header("Location: fileName"); //This redirects to that page
    exit(); // always call exit() after header redirect as we need to end this script

    //---------------------------------------


}






?>

<Html>

    <form action="" method="post">
        <label>Name: </label><br>
        <input placeholder="Name" name='name'></br></br>

        <label>Email: </label><br>
        <input placeholder="Email" name='email'></br></br>

        <label>Age: </label><br>
        <input placeholder="Age" name='age'></br></br>

        <button type="submit" name="submit" value="submit_btn_was_clicked">Submit </button> <!-- this thing in value we get in the $_POST['submit'] -->
    <form>
</HTML>


<?php
include 'footer.php'
?>