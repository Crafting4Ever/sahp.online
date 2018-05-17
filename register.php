<?php

$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");
    
}
else {

    $sql = "INSERT INTO users (first_name, last_name, email, password, hash) " 
            . "VALUES ('$first_name','$last_name','$email','$password', '$hash')";

    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 0;
        $_SESSION['logged_in'] = true;
        $_SESSION['message'] =
                
                 "Confirmation link has been sent to the website admins, please contact
                   ***************** *. **-*** on Discord or Teamspeak to get verifed.";
        $to      = 'admin@sahp.online';
        $subject = 'User Verification ( '.$first_name.' '.$last_name.' )';
        $message_body = '
        Hello '.$first_name.',

        A new user has registerd, upon them contacting you on Discord/Teamspeak,
		Give them this link below. (Or you can just run it yourself but I do not recommend.)

        https://sahp.online/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body );

        header("location: profile.php"); 
        

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}