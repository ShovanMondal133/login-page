<?php

include 'connect.php';
if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POst['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=mds($password);

    $checkEmail="SELECT*From users where email='$email";
    $result=$conn->query($checkEmail);
    if($result->num_rows>0){
        echo "Email Address allready Exists !";
    }
    else{
        $insertQuery="INSERT INTO users(firstName,lastName,email,password)
                       VALUES('$firstName','$lastName','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location:index.html");
            }
            else{
                echo"Error:".$conn->error;
            }
    }

}

if(isset($_POST['signIn'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $sql="SELECT * FROM users WHERE email='$email'and password='$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['email']=$row['email'];
        header("location: homepage.php");
        exit();

    }
    else{
        echo"Not FOund,Incorrect Email or Password";
         
    }
}
?>