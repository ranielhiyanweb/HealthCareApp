<?php 

include_once 'connect.php';


$username = @$_POST['username'];
$email = @$_POST['email'];
$password = @$_POST['password'];
$confirmPassword = @$_POST['confirmPassword'];

$username = "admin";
$email = "ranielhiyann@gmail.com";
$password = "admin";
$confirmPassword = "admin";


if(defined('PASSWORD_ARGON2ID')){
    $password = @$_POST['password'];
    $password = "admin";

    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

}else{
    echo "Argon2id is not supported. Your PHP version might be outdated.";
}

  $sqli = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
  $result = mysqli_query($conn, $sqli);

  if(mysqli_num_rows($result) > 0){
    echo "Duplicate";
  } else if(mysqli_num_rows($result) == 0){
    // Proceed with user registration
    $sqli = "INSERT INTO users (username, email, password) VALUES ($username, $email, $hashedPassword)";
    mysqli_query($conn, $sqli);
    $sql3 = "INSERT INTO login(username, password) VALUES ($username, $hashedPassword)";
    mysqli_query($conn, $sql3);
    echo "Sign UpSuccess";
  }else{
    echo "Failed";
  }


?>