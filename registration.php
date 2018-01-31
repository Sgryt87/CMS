<?php include "includes/db.php"; ?>
<?php session_start(); ?>
<?php include "includes/header.php";
include 'admin/functions.php';

$message = '';
$usernameErr = '';
$emailErr = '';
$passwordErr = '';
$repasswordErr = '';

if (isset($_POST['submit'])) {

    $username = escape($_POST['username']);
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);

    //name
    if (empty($_POST["username"])) {
        $emailError = "Username Is Required";
    } else if (strlen($email) <= 2) {
        $emailError = "Your Username Must Contain At Least 2 Characters";
    } else {
        if (usernameExists($username)) {
            $usernameErr = 'This Username Already Exists';
        } else if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
            $usernameError = "Only Letters And White Space Allowed";
        }
    }

    // email
    if (empty($_POST["email"])) {
        $emailErr = "Email Is Required";
    } else {
        if (emailExists($email)) {
            $emailErr = 'This Email Already Exists';
        } else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            $emailErr = "Invalid Email";
        }
    }
    // password
    if (!empty($_POST["password"]) && ($_POST["password"] === $_POST["repassword"])) {
        $password = escape($_POST["password"]);
        $repassword = escape($_POST["repassword"]);
        if (strlen($_POST["password"]) <= '6') {
            //it could be any length;
            $passwordErr = "Your Password Must Contain At Least 6 Characters!";
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Number!";
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        }
//        elseif(!preg_match("#[a-z]+#",$password)) {
//            $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
//        }
    } elseif (!empty($_POST["password"])) {
        $repasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
    } else {
        $passwordErr = "Please Enter Password";
    }
    if ($usernameErr == '' &&
        $emailErr == '' &&
        $password == '') {

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        $query = "INSERT INTO users (
                                username,
                                user_email,
                                user_password,
                                user_role)
                                 VALUES (
                                '{$username}',
                                '{$email}',
                                '{$password}',
                                'subscriber')";
        $register_user_query = mysqli_query($connection, $query);
        if (!$register_user_query) {
            die('Query Failed' . mysqli_error($connection) . ' ' . mysqli_errno($connection));
        } else {
            $message = "Registration has been submitted";
        }
    }
}
?>
<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Registration</h1>
                        <br>
                        <h5 class="text-center text-success center-block"><?php echo $message; ?></h5>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h5 class="text-center text-danger"><?php echo $usernameErr; ?></h5>
                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="Username">
                            </div>
                            <div class="form-group">
                                <h5 class="text-center text-danger"><?php echo $emailErr; ?></h5>
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="youremail@example.com">
                            </div>
                            <div class="form-group">
                                <h5 class="text-center text-danger"><?php echo $passwordErr; ?></h5>
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                       placeholder="Password">
                                <h6 class="text-info">*Your Password Must Contain At Least 6 Characters And One Number</h6>
                            </div>
                            <div class="form-group">
                                <h5 class="text-center text-danger"><?php echo $passwordErr; ?></h5>
                                <h5 class="text-center text-danger"><?php echo $repasswordErr; ?></h5>
                                <label for="repassword" class="sr-only form-group">Confirm Password</label>
                                <input type="password" name="repassword" id="rekey" class="form-control"
                                       placeholder="Confirm Password">
                                <h6 class="text-info">*Confirm Password</h6>
                            </div>
                            <input type="submit" name="submit" id="btn-login" class="btn btn-default btn-lg btn-block"
                                   value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>


    <?php include "includes/footer.php"; ?>
