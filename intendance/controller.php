<?php
    include("db_connect.php");
    session_start();
    $errors = [];

    if (isset($_POST['forgot_password'])) {
        $email = $_POST['email'];
        $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

            if (mysqli_num_rows($emailCheckResult) > 0) {
                $code = rand(999999, 111111);
                $updateQuery = "UPDATE users SET code = $code WHERE email = '$email'";
                $updateResult = mysqli_query($conn, $updateQuery);
                if ($updateResult) {
                    $subject = "Email Verification Code";
                    $message = "verification code is $code";
                    $sender = "From: hillpatel1357@gmail.com";
                    if (mail($email, $subject, $message, $sender)){
                        $info = "We've sent you a verification code to your Email <br> $email";
                        $_SESSION['info'] = $info;
                        $_SESSION['email'] = $email;
                        header('location: verifyEmail.php');
                    } else {
                        $errors['otp_errors'] = "Failed while sending code!";
                    }
            }else{
                $errors['db_error'] = "Failed while checking email from database!";
            }
        }else {
            $errors['invalidEmail'] = "Invalid Email Address";
        }
    }


    
  
if(isset($_POST['verifyEmail'])){
    $_SESSION['info'] = "";
    $OTPverify = mysqli_real_escape_string($conn, $_POST['OTPverify']);
    $verifyQuery = "SELECT * FROM users WHERE code = $OTPverify";
    $runVerifyQuery = mysqli_query($conn, $verifyQuery);
    if($runVerifyQuery){
        if(mysqli_num_rows($runVerifyQuery) > 0){
            $newQuery = "UPDATE users SET code = 0";
            $run = mysqli_query($conn,$newQuery);
            header("location: newPassword.php");
        }else{
            $errors['verification_error'] = "Invalid Verification Code";
        }
    }else{
        $errors['db_error'] = "Failed while checking Verification Code from database!";
    }
}
if(isset($_POST['changePassword'])){
    $password = md5($_POST['password']);
    $confirmPassword = md5($_POST['confirmPassword']);
        if ($_POST['password'] != $_POST['confirmPassword']) {
            $errors['password_error'] = 'Password not matched';
        } else  {
            $email = $_SESSION['email'];
            $updatePassword = "UPDATE users SET password = '$password' WHERE email = '$email'";
            $updatePass = mysqli_query($conn, $updatePassword) or die("Query Failed");
            session_destroy();
            header('location: login.php');
        }
    }
?>